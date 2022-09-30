<?php

namespace App\Http\Resources\Offer;

use App\Enums\OrderEnum;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,

            "service_id" => $this->service_id,
            "order" => [
                "id"  => $this->order->id,
                "order_code" => $this->order->order_code
            ],
            "captain" => [
                "id" => $this->captain_id,
                "name" => $this->captain->name,
                "profile_image" => $this->captain->profile_image,
                "joint_from" => $this->captain->captain->created_at->format('Y'),
                "rate" => 0,
                "number_of_orders" => DB::table("orders")->where("captain_id", $this->captain_id)->where("order_status", OrderEnum::DELIVERED)->count(),
            ],

            "captain_lat" => $this->captain_lat,
            "captain_long" => $this->captain_long,
            "distance" => $this->distance,

            "offer_status" => $this->offer_status,
            "price" => $this->price,

            "is_between_governorate_service" => $this->is_between_governorate_service == 1,
            "governorate_from_id" => $this->governorate_from_id,
            "governorate_to_id" => $this->governorate_to_id,
            "between_governorate_date" => $this->between_governorate_date,
        ];
    }
}
