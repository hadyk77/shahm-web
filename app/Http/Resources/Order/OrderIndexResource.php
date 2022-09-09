<?php

namespace App\Http\Resources\Order;

use App\Helper\Helper;
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
            "items_price" => $this->items_price,
            "delivery_cost" => $this->delivery_cost,
            "tax" => $this->tax,
            "grand_total" => $this->grand_total,
            "order_status" => $this->order_status,
            "order_items" => $this->order_items,
            "drop_off_location" => $this->drop_off_location,
            "created_at" => Helper::formatDate($this->created_at)
        ];
    }
}
