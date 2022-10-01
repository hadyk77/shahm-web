<?php

namespace App\Services\Order;

use App\Actions\NotificationActions\NotifyAdminWithNewOrderRequest;
use App\Actions\NotificationActions\NotifyClientWithCreationOfOrderAction;
use App\Enums\OrderEnum;
use App\Models\ExpectedPriceRange;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Services\ServiceInterface;
use App\Support\CalculateDistanceBetweenTwoPoints;
use Auth;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class OrderServices implements ServiceInterface
{
    public function get(): array|Collection
    {
        return Order::query()->get();
    }

    public function getClientOrders($request): array|Collection
    {
        $orders = Order::query()->where("user_id", Auth::id());
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
        return $orders->get();
    }

    public function findClientOrderById($id): Order
    {
        return Order::query()->where("user_id", Auth::id())->findOrFail($id);
    }

    public function getCaptainOrders(): array|Collection
    {
        return Order::query()->where("captain_id", Auth::id())->get();
    }

    public function findCaptainOrderById($id): Order
    {
        return Order::query()->where("captain_id", Auth::id())->findOrFail($id);
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return Order::query()->with(["client", "service"])->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            $gs = GeneralSetting::query()->first();

            [$distance, $expectedRangeId] = $this->calculateLocationDistance(
                lat1: $request->pickup_location_lat,
                long1: $request->pickup_location_long,
                lat2: $request->drop_off_location_lat,
                long2: $request->drop_off_location_long,
            );

            $order = Order::query()->create([
                "service_id" => $request->service_id,
                "user_id" => Auth::id(),
                "order_items" => $request->order_items,
                "order_type" => $request->order_type,
                "payment_method" => $request->payment_method,

                //Locations
                "drop_off_location" => $request->drop_off_location,
                "drop_off_description" => $request->drop_off_description,
                "drop_off_location_lat" => $request->drop_off_location_lat,
                "drop_off_location_long" => $request->drop_off_location_long,
                "pickup_location" => $request->pickup_location,
                "pickup_description" => $request->pickup_description,
                "pickup_location_lat" => $request->pickup_location_lat,
                "pickup_location_long" => $request->pickup_location_long,
                "distance" => $distance,
                "expected_price_range_id" => $expectedRangeId,

                "tax" => 0,
                "tax_percentage" => $gs->tax,
                "discount_code" => $request->discount_code,
            ]);

            if ($request->hasFile('image')) {

                $order->addMedia($request->image)->toMediaCollection(OrderEnum::IMAGE);

            }

            $order->refresh();

            $this->updateOrderCode($order);

            NotifyAdminWithNewOrderRequest::run($order);

            $this->storeHistoryForOrder(order: $order, is_client_notified: true);

            NotifyClientWithCreationOfOrderAction::run(Auth::user(), $order);

            return $order;
        });
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    private function updateOrderCode(Order $order)
    {
        $order->update([
            "order_code" => "0000" . $order->id,
        ]);
    }

    public function storeHistoryForOrder($order, $type = "change_order_status", $is_client_notified = false): void
    {
        $commentAr = "";
        $commentEn = "";

        if ($type == "change_order_status") {
            if ($order->order_status == OrderEnum::WAITING_OFFERS) {
                $commentAr = "تم استلام الطلب";
                $commentEn = "Order Received";
            }
            if ($order->order_status == OrderEnum::IN_PROGRESS) {
                $commentAr = "الطلب تحت التنفيذ";
                $commentEn = "Order is in progress";
            }
            if ($order->order_status == OrderEnum::DELIVERED) {
                $commentAr = "تم تسليم الطلب";
                $commentEn = "Order is Delivered";
            }
            if ($order->order_status == OrderEnum::CANCELED) {
                $commentAr = "تم إلغاء الطلب";
                $commentEn = "Order is Canceled";
            }
        }

        OrderHistory::query()->create([
            "order_id" => $order->id,
            "comment" => [
                "ar" => $commentAr,
                "en" => $commentEn
            ],
            "type" => $type,
            "order_status" => $order->order_status,
            "is_client_notified" => $is_client_notified,
        ]);
    }

    private function calculateLocationDistance($lat1, $long1, $lat2, $long2): array
    {
        $distance = CalculateDistanceBetweenTwoPoints::calculateDistanceBetweenTwoPoints($lat1, $long1, $lat2, $long2);

        $maximumExpectedDistance = ExpectedPriceRange::query()->max("kilometer_to");

        if ($distance > $maximumExpectedDistance) {
            throw new Exception(__("Can't deliver for this distance"));
        }

        $expectedRangeId = ExpectedPriceRange::query()
            ->where("kilometer_from", "<=", $distance)
            ->where("kilometer_to", ">=", $distance)
            ->first()?->id;

        return [$distance, $expectedRangeId];
    }
}
