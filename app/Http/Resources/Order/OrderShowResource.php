<?php

namespace App\Http\Resources\Order;

use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderShowResource extends JsonResource
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
            "items_price" => $this->items_price,
            "captain" => $this->mergeWhen($this->captain_id != null, function () {
                return [
                    "id" => $this->captain->id,
                    "name" => $this->captain->user->name,
                ];
            }),
            "delivery_cost" => $this->delivery_cost,
            "tax" => $this->tax,
            "grand_total" => $this->grand_total,
            "order_status" => $this->order_status,
            "order_items" => $this->order_items,

            // Locations
            "drop_off_location" => $this->drop_off_location,
            "drop_off_description" => $this->drop_off_description,
            "drop_off_location_lat" => $this->drop_off_location_lat,
            "drop_off_location_long" => $this->drop_off_location_long,
            "pickup_location" => $this->drop_off_location,
            "pickup_description" => $this->pickup_description,
            "pickup_location_lat" => $this->pickup_location_lat,
            "pickup_location_long" => $this->pickup_location_long,

            "payment_method" => $this->payment_method,
            "payment_status" => $this->payment_status,
            "created_at" => Helper::formatDate($this->created_at)
        ];
    }
}
