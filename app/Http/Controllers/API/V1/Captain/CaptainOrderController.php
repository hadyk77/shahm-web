<?php

namespace App\Http\Controllers\API\V1\Captain;

use App\Enums\OrderEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderIndexResource;
use App\Models\Order;
use App\Notifications\Order\OrderStatusNotification;
use Auth;
use Illuminate\Http\Request;

class CaptainOrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->where("captain_id", Auth::id())->get();
        return $this::sendSuccessResponse(OrderIndexResource::collection($orders));
    }

    public function show($id)
    {
        $order = Order::query()->where("captain_id", Auth::id())->findOrFail($id);
        return $this::sendSuccessResponse(OrderIndexResource::make($order));
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
        $order = Order::query()->where("captain_id", Auth::id())->findOrFail($id);
    }
}
