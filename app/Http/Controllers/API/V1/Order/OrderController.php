<?php

namespace App\Http\Controllers\API\V1\Order;

use App\Actions\NotificationActions\NotifyNearCaptainsWithNewOrderAction;
use App\Enums\OrderEnum;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Order\OrderRequest;
use App\Http\Resources\Governorate\GovernorateResource;
use App\Http\Resources\Order\OrderIndexResource;
use App\Http\Resources\Order\OrderShowResource;
use App\Models\BetweenGovernorateService;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Notifications\Order\OrderCanceledNotification;
use App\Services\Order\OrderServices;
use Auth;
use Carbon\Carbon;
use Http\Discovery\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;
use PDF;
use Spatie\TemporaryDirectory\TemporaryDirectory;
use Str;
use Throwable;

class OrderController extends Controller
{
    public function __construct(private readonly OrderServices $orderServices)
    {

    }

    public function index(Request $request)
    {
        $orders = Order::query()
            ->where("user_id", Auth::id())
            ->latest("created_at")
            ->when($request->filled("from") && $request->from != "" && $request->filled("to") && $request->to != "", function ($query) use ($request) {
                $from = (int)$request->from;
                $to = (int)$request->to;

                $total = $to - $from + 1;
                $skip = $from - 1;

                $query->skip($skip)->take($total);
            });

        if ($request->filled("status")) {
            if ($request->status == "active") {
                $orders = $orders
                    ->where("order_status", "!=", OrderEnum::DELIVERED)
                    ->where("order_status", "!=", OrderEnum::CANCELED);
            }
            if (in_array($request->status, array_keys(OrderEnum::statues()))) {
                $orders = $orders->where("order_status", $request->status);
            }
        }


        return $this::sendSuccessResponse([
            "count" => $orders->count(),
            "data" => OrderIndexResource::collection($orders->get())
        ]);
    }

    public function show($id)
    {
        $orders = $this->orderServices->findClientOrderById($id);
        return $this::sendSuccessResponse(OrderShowResource::make($orders));
    }

    public function store(OrderRequest $request)
    {
        try {
            $this->orderServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __("Order Created Successfully"));
    }

    public function cancelOrder(Request $request, $id)
    {
        $this->validate($request, [
            "reason" => "nullable|string"
        ]);
        $order = $this->orderServices->findClientOrderById($id);
        if (!in_array($order->order_status, [OrderEnum::IN_PROGRESS, OrderEnum::WAITING_OFFERS])) {
            return $this::sendSuccessResponse([], __("Order Cannot be canceled"));
        }
        try {
            $order->update([
                "order_status" => OrderEnum::CANCELED,
                "cancel_reason" => $request->reason,
            ]);
            $order->captain?->notify(new OrderCanceledNotification($order));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("Order Canceled Successfully"));
    }

    public function changeOrder($id)
    {
        $order = $this->orderServices->findClientOrderById($id);

        if ($order->order_status == OrderEnum::WAITING_OFFERS) {
            return $this::sendFailedResponse(__("Order not has any captains yet"));
        }

        try {
            $order->update([
                "order_status" => OrderEnum::WAITING_OFFERS,
                "captain_id" => null,
                "app_profit_from_captain" => null,
                "app_profit_from_user" => null,
                "captain_profit" => null,
                "delivery_cost_with_user_commission" => null,
                "delivery_cost_without_user_commission" => null,
                "tax" => 0,
                "tax_percentage" => 0,
                "grand_total" => null,
            ]);

            NotifyNearCaptainsWithNewOrderAction::run($order);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __("Order Send to offers agains"));
    }

    public function getEnabledBetweenGovernorateService()
    {
        $captains = BetweenGovernorateService::query()
            ->whereDate("between_governorate_date", ">=", Carbon::now()->format("Y-m-d"))
            ->where("between_governorate_time", ">=", Carbon::now()->format("H:i:s"))
            ->whereHas("captain.captain", function ($query) {
                $query
                    ->where("users.status", 1)
                    ->where("users.captain_status", 1)
                    ->where("captains.enable_order", 1);
            })
            ->get()
            ->map(function (BetweenGovernorateService $betweenGovernorateService) {
                return [
                    "between_governorate_service" => $betweenGovernorateService->id,
                    "captain_id" => $betweenGovernorateService->captain->id,
                    "name" => $betweenGovernorateService->captain->name,
                    "profile_image" => $betweenGovernorateService->captain->profile_image,
                    "joined_at" => $betweenGovernorateService->captain->created_at->format('Y'),
                    "number_of_orders" => DB::table("orders")->where("captain_id", $betweenGovernorateService->captain->id)->where("order_status", OrderEnum::DELIVERED)->count(),
                    "rate" => 0,
                    "time" => $betweenGovernorateService->between_governorate_time,
                    "date" => $betweenGovernorateService->between_governorate_date,
                    "from" => GovernorateResource::make($betweenGovernorateService->governorateFrom),
                    "to" => GovernorateResource::make($betweenGovernorateService->governorateTo),
                ];
            });

        return $this::sendSuccessResponse($captains);
    }

    public function changePaymentMethod(Request $request, $id)
    {

        $this->validate($request, [
            "payment_method" => "required|in:" . implode(",", array_keys(OrderEnum::enabledPaymentMethods())),
        ]);

        $order = $this->orderServices->findClientOrderById($id);

        if ($order->payment_status == OrderEnum::PAID) {

            return $this::sendSuccessResponse([], __('Order is already paid'));

        }

        $order->update([
            "payment_method" => $request->payment_method,
        ]);

        return $this::sendSuccessResponse([], __("Payment Changed"));
    }

    public function payOrder($id)
    {
        $order = $this->orderServices->findClientOrderById($id);

        if ($order->payment_status == OrderEnum::PAID) {

            return $this::sendSuccessResponse([], __('Order is already paid'));

        }

        if ($order->chat->is_captain_send_invoice == 0) {

            return $this::sendSuccessResponse([], __('Captain does\'t send export invoice message'));

        }

        $order->update([
            "payment_status" => OrderEnum::PAID,
        ]);

        $order->chat->update([
            "is_client_pay_invoice" => 1,
        ]);

        $this->orderServices->sendTransactionToCaptain($order);

        return $this::sendSuccessResponse([], __("Order Paid successfully"));

    }

    public function downloadInvoice($id)
    {
        $order = Order::query()->find($id);
        if (Helper::isCaptain($order)) {
            $order = Order::query()->where("captain_id", Auth::id())->findOrFail($id);
        } else {
            $order = Order::query()->where("user_id", Auth::id())->findOrFail($id);
        }

        $pdf = PDF::loadView('order_invoice', [
            'order' => $order,
            "gs" => GeneralSetting::query()->firstOrFail(),
        ]);

        $dirName = Str::random(200);

        $fileName = Str::uuid() . '.pdf';

        $temporaryDirectory = (new TemporaryDirectory())
            ->name($dirName)
            ->location(storage_path('app/public/invoices'))
            ->create()
            ->path($fileName);

        $pdf->save($temporaryDirectory);

        return $this::sendSuccessResponse([
            'link' => url('storage/invoices/' . $dirName . '/' . $fileName)
        ], __("Invoice download Link"));
    }
}
