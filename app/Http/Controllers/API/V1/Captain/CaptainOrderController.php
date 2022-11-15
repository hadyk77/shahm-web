<?php

namespace App\Http\Controllers\API\V1\Captain;

use App\Actions\NotificationActions\NotifyNearCaptainsWithNewOrderAction;
use App\Enums\OrderEnum;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\ChatMessagesResource;
use App\Http\Resources\Order\OrderIndexResource;
use App\Http\Resources\Order\OrderShowResource;
use App\Models\CaptainVerificationFile;
use App\Models\ExpectedPriceRange;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Notifications\Order\CaptainWithdrawalFromOrderNotification;
use App\Notifications\Order\NewOrderNotification;
use App\Notifications\Order\OrderStatusNotification;
use App\Services\Chat\ChatServices;
use App\Services\Order\OrderServices;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class CaptainOrderController extends Controller
{

    public function newOrder(Request $request)
    {
        $delivery_types = Helper::getCaptainDeliveryTypes();
        $max_radius = (float)GeneralSetting::query()->first()->max_radius;
        $new_orders = Order::query()
            ->when(!in_array("all", $delivery_types), function ($query) use ($delivery_types) {
                $query->whereIn("order_type", $delivery_types);
            })
            ->where("order_status", "!=", OrderEnum::CANCELED)
            ->where("order_status", OrderEnum::WAITING_OFFERS)
            ->where(function ($query) {
                return $query->where("captain_id", null)->orWhere("captain_id", Auth::id());
            })
            ->get()
            ->filter(function (Order $order) use ($max_radius) {
                if ($order->service_id == 2) {
                    $distance = Helper::getLocationDetailsFromGoogleMapApi(Auth::user()->address_lat, Auth::user()->address_long, $order->drop_off_location_lat, $order->drop_off_location_long)["distanceValue"];
                } else {
                    $distance = Helper::getLocationDetailsFromGoogleMapApi(Auth::user()->address_lat, Auth::user()->address_long, $order->pickup_location_lat, $order->pickup_location_long)["distanceValue"];
                }
                if ($distance <= $max_radius && $distance != 0) {
                    return true;
                }
                return false;
            });

        return $this::sendSuccessResponse(OrderIndexResource::collection($new_orders));
    }

    public function myOrder(Request $request)
    {

        $orders = Order::query()
            ->where("captain_id", Auth::id())
            ->when($request->filled("from") && $request->from != "" && $request->filled("to") && $request->to != "", function ($query) use ($request) {
                $from = (int)$request->from;
                $to = (int)$request->to;

                $total = $to - $from + 1;
                $skip = $from - 1;

                $query->skip($skip)->take($total);
            });


        if ($request->filled("status")) {
            $this->validate($request, [
                "status" => "nullable|array",
                "status.*" => "nullable|in:" . implode(",", array_keys(OrderEnum::statues()))
            ]);
            $orders = $orders->whereIn("order_status", $request->status);
        }

        $orders = $orders->get();

        return $this::sendSuccessResponse([
            "count" => DB::table("orders")->where("captain_id",Auth::id())->count(),
            "data" => OrderIndexResource::collection($orders)
        ]);
    }

    public function show($id)
    {
        $order = Order::query()->findOrFail($id);
        if ($order->captain_id != null) {
            $order = Order::query()->where("captain_id", Auth::id())->findOrFail($id);
        }

        return $this::sendSuccessResponse(OrderShowResource::make($order));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $this->validate($request, [
            "status" => "required|in:" .
                OrderEnum::CAPTAIN_RECEIVED_ORDER
                . ',' .
                OrderEnum::CAPTAIN_IN_CLIENT_LOCATION
                . ',' .
                OrderEnum::DELIVERED
                . ',' .
                OrderEnum::CANCELED
        ]);

        $order = Order::query()->where("captain_id", Auth::id())->findOrFail($id);

        if ($order->order_status == OrderEnum::DELIVERED) {
            return $this::sendFailedResponse(__("Order is already delivered"));
        }

        if ($order->order_status == OrderEnum::CANCELED) {
            return $this::sendFailedResponse(__("Order is already canceled"));
        }

        $order->update([
            "order_status" => $request->status,
        ]);

        $order->client->notify(new OrderStatusNotification($order));

        return $this::sendSuccessResponse([], __("Status Updated"));
    }

    public function updateOrderDetails(Request $request, $id)
    {
        $this->validate($request, [
            "items_price" => "required|numeric",
            "purchasing_image" => Helper::imageRules(),
        ]);

        $gs = GeneralSetting::query()->first();

        $order = Order::query()->where("captain_id", Auth::id())->findOrFail($id);

        $grand_total = (1 + ($gs->tax / 100)) * $order->offer_total_cost;

        $order->update([
            "items_price" => $grand_total + (double)$request->items_price,
        ]);

        if ($request->hasFile("purchasing_image")) {
            $order->addMedia($request->file('purchasing_image'))->preservingOriginal()->toMediaCollection(OrderEnum::PURCHASING_IMAGE);
        }

        $order->chat->update([
            'is_captain_send_invoice' => 1,
        ]);

        $chatServices = new ChatServices();
        $messages = $chatServices->sendExportInvoiceMessage($order, $request);


        return $this::sendSuccessResponse([
            "messages" => ChatMessagesResource::collection($messages),
        ], __("Order Updated"));
    }

    public function withdrawalFromOrder($order_id)
    {
        $order = Order::query()->where("captain_id", Auth::id())->findOrFail($order_id);

        if ($order->order_status == OrderEnum::DELIVERED) {
            return $this::sendFailedResponse(__("Order is already delivered"));
        }

        if ($order->order_status == OrderEnum::CANCELED) {
            return $this::sendFailedResponse(__("Order is already canceled"));
        }

        if ($order->order_status == OrderEnum::WITHDRAWAL_FROM_CAPTAIN) {
            return $this::sendFailedResponse(__("Order is already withdrawal from captain"));
        }

        if ($order->order_status == OrderEnum::WITHDRAWAL_FROM_CLIENT) {
            return $this::sendFailedResponse(__("Order is already withdrawal from client"));
        }

        $order->update([
            "order_status" => OrderEnum::WITHDRAWAL_FROM_CAPTAIN,
        ]);

        $order->refresh();

        if ($order->service_id != 3) {

            DB::transaction(function () use ($order) {

                $newOrder = Order::query()->create([
                    "service_id" => $order->service_id,
                    "user_id" => $order->user_id,
                    "order_items" => $order->order_items,
                    "order_type" => $order->order_type,
                    "order_status" => OrderEnum::WAITING_OFFERS,
                    "payment_method" => $order->payment_method,
                    "drop_off_location" => $order->drop_off_location,
                    "drop_off_description" => $order->drop_off_description,
                    "drop_off_location_lat" => $order->drop_off_location_lat,
                    "drop_off_location_long" => $order->drop_off_location_long,
                    "pickup_location" => $order->pickup_location,
                    "pickup_description" => $order->pickup_description,
                    "pickup_location_lat" => $order->pickup_location_lat,
                    "pickup_location_long" => $order->pickup_location_long,
                    "distance" => $order->distance,
                    "expected_price_range_id" => $order->expected_price_range_id,
                    "tax" => $order->tax,
                    "tax_percentage" => $order->tax_percentage,
                    "discount_code" => $order->discount_code,
                ]);

                $newOrder->update([
                    "order_code" => "0000" . $newOrder->id,
                ]);

                NotifyNearCaptainsWithNewOrderAction::run($order, Auth::id());

                (new OrderServices())->storeHistoryForOrder($order);

                return $newOrder;
            });
        }

        return $this::sendSuccessResponse([], __("Captain withdrawal successfully"));

    }


}
