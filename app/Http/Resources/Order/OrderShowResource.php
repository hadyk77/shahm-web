<?php

namespace App\Http\Resources\Order;

use App\Enums\OrderEnum;
use App\Helper\Helper;
use App\Http\Resources\Captain\BetweenGovernorateServiceResource;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\ExpectedPriceRange\ExpectedPriceRangeResource;
use App\Models\User;
use DB;
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
            "between_governorate_service" => $this->mergeWhen($this->service_id == 3, function () {
                return BetweenGovernorateServiceResource::make($this->betweenGovernorateService);
            }),
            "items_price" => $this->items_price,
            "captain" => $this->mergeWhen($this->captain_id != null, function () {
                return [
                    "id" => $this->captain->id,
                    "name" => $this->captain->name,
                    "image" => $this->captain->profile_image,
                    "phone" => $this->captain->phone,
                    "address" => [
                        "location" => $this->captain->address,
                        "lat" => $this->captain->address_lat,
                        "long" => $this->captain->address_long,
                    ],
                    "captain_rate" => DB::table("rates")->where("model_type", User::class)->where("model_id", $this->captain->id)->average("rate") ?? 0,
                ];
            }),
            "app_profit_from_captain" => $this->app_profit_from_captain,
            "captain_profit" => $this->captain_profit,
            "app_profit_from_user" => $this->app_profit_from_user,
            "delivery_cost_with_user_commission" => $this->delivery_cost_with_user_commission,
            "delivery_cost_without_user_commission" => $this->delivery_cost_without_user_commission,
            "tax" => $this->tax,
            "grand_total" => $this->grand_total,
            "order_status" => $this->order_status,
            "cancel_reason" => $this->cancel_reason,
            "order_items" => $this->order_items,
            "distance" => $this->distance,
            "expected_price_range" => [
                "price_from" => $this->expectedPriceRange?->price_from,
                "price_to" => $this->expectedPriceRange?->price_to,
            ],
            "client" => [
                "id" => $this->client->id,
                "name" => $this->client->name,
                "profile_image" => $this->client->profile_image,
                "phone" => $this->client->phone,
                "email" => $this->client->email,
                "user_rate" => DB::table("rates")->where("model_type", User::class)->where("model_id", $this->id)->average("rate") ?? 0,
            ],

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

            "client_image" => $this->getFirstMediaUrl(OrderEnum::IMAGE),
            "purchasing_image" => $this->getFirstMediaUrl(OrderEnum::PURCHASING_IMAGE),

            "chat" => ChatResource::make($this->chat),

            "created_at" => Helper::formatDate($this->created_at)
        ];
    }
}
