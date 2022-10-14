<?php

namespace App\Http\Resources\Order;

use App\Helper\Helper;
use App\Support\CalculateDistanceBetweenTwoPoints;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderIndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "order_code" => $this->order_code,
            "service" => [
                "id" => $this->service->id,
                "title" => $this->service->title,
                "icon" => $this->service->icon
            ],
            "expected_price_range" => [
                "price_from" => $this->expectedPriceRange?->price_from,
                "price_to" => $this->expectedPriceRange?->price_to,
            ],
            "items_price" => $this->items_price,
            "captain_profit" => $this->captain_profit,
            "app_profit_from_captain" => $this->app_profit_from_captain,
            "app_profit_from_user" => $this->app_profit_from_user,
            "delivery_cost_with_user_commission" => $this->delivery_cost_with_user_commission,
            "delivery_cost_without_user_commission" => $this->delivery_cost_without_user_commission,
            "grand_total" => $this->grand_total,
            "tax" => $this->tax,
            'distance' => $this->mergeWhen(Auth::user()->is_captain, function () {
                return [
                    "drop_off_distance" => CalculateDistanceBetweenTwoPoints::calculateDistanceBetweenTwoPoints(
                        Auth::user()->address_lat,
                        Auth::user()->address_long,
                        $this->drop_off_location_lat,
                        $this->drop_off_location_long
                    ),
                    "pickup_distance" => CalculateDistanceBetweenTwoPoints::calculateDistanceBetweenTwoPoints(
                        Auth::user()->address_lat,
                        Auth::user()->address_long,
                        $this->pickup_location_lat,
                        $this->pickup_location_long
                    ),
                ];
            }),
            "order_status" => $this->order_status,
            "order_items" => $this->order_items,
            "drop_off_location" => $this->drop_off_location,
            "created_at" => Helper::formatDate($this->created_at)
        ];
    }
}
