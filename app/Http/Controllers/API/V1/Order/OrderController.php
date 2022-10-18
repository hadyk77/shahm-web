<?php

namespace App\Http\Controllers\API\V1\Order;

use App\Actions\NotificationActions\NotifyNearCaptainsWithNewOrderAction;
use App\Enums\OrderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Order\OrderRequest;
use App\Http\Resources\Governorate\GovernorateResource;
use App\Http\Resources\Order\OrderIndexResource;
use App\Http\Resources\Order\OrderShowResource;
use App\Models\BetweenGovernorateService;
use App\Models\Captain;
use App\Models\Order;
use App\Models\User;
use App\Notifications\Order\OrderCanceledNotification;
use App\Services\Order\OrderServices;
use Carbon\Carbon;
use Http\Discovery\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;
use Throwable;

class OrderController extends Controller
{
    public function __construct(private readonly OrderServices $orderServices)
    {

    }

    public function index(Request $request)
    {
        $orders = $this->orderServices->getClientOrders($request);
        return $this::sendSuccessResponse(OrderIndexResource::collection($orders));
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

    public function cancelOrder($id)
    {
        $order = $this->orderServices->findClientOrderById($id);
        if (!in_array($order->order_status, [OrderEnum::IN_PROGRESS, OrderEnum::WAITING_OFFERS])) {
            return $this::sendSuccessResponse([], __("Order Cannot be canceled"));
        }
        try {
            $order->update([
                "order_status" => OrderEnum::CANCELED
            ]);
            $order->captain->notify(new OrderCanceledNotification($order));
        } catch (\Exception $exception) {
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
}
