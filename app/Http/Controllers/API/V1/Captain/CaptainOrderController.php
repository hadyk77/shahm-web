<?php

namespace App\Http\Controllers\API\V1\Captain;

use App\Enums\OrderEnum;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderIndexResource;
use App\Http\Resources\Order\OrderShowResource;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Notifications\Order\OrderStatusNotification;
use Auth;
use Illuminate\Http\Request;

class CaptainOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()->where("captain_id", Auth::id());

        if ($request->filled("status") && $request->status != "") {

            if ($request->status == "new") {
                $orders = $orders->whereIn("order_status", [
                    OrderEnum::IN_PROGRESS,
                    OrderEnum::CAPTAIN_IN_CLIENT_LOCATION,
                    OrderEnum::CAPTAIN_RECEIVED_ORDER,
                ]);
            }

            if ($request->status == "old") {
                $orders = $orders->whereNotIn("order_status", [
                    OrderEnum::IN_PROGRESS,
                    OrderEnum::CAPTAIN_IN_CLIENT_LOCATION
                ]);
            }

        }

        return $this::sendSuccessResponse(OrderIndexResource::collection($orders->get()));
    }

    public function show($id)
    {
        $order = Order::query()->where("captain_id", Auth::id())->findOrFail($id);
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
            $order->addMedia($request->file('purchasing_image'))->toMediaCollection(OrderEnum::PURCHASING_IMAGE);
        }

        return $this::sendSuccessResponse([], __("Order Updated"));
    }
}
