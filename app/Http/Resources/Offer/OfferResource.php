<?php

namespace App\Http\Resources\Offer;

use App\Enums\OrderEnum;
use App\Models\Captain;
use App\Models\Rate;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    public function toArray($request): array
    {

        $is_best_offer = false;

        $minDistance = DB::table("offers")->where("order_id", $this->order?->id)->min("distance");
        $minPrice = DB::table("offers")->where("order_id", $this->order?->id)->min("price");
        $captainsIds = DB::table("offers")->where("order_id", $this->order?->id)->pluck('captain_id')->toArray();
        $highestRate = DB::table("rates")
            ->where("model_type", Captain::class)
            ->whereIn("model_id", DB::table("captains")->whereIn('user_id', $captainsIds)->pluck('id')->toArray())
            ->max('rate');

        if ($this->distance == $minDistance && $this->price == $minPrice) {

            $captainId = DB::table("rates")
                ->where("model_type", Captain::class)
                ->where("model_id", $this->captain->captain->id)
                ->where('rate', $highestRate)
                ->first()?->model_id;

            $userId = Captain::query()->find($captainId)?->user_id;

            if ($this->captain_id == $userId) {
                $is_best_offer = true;
            }
        }

        return [
            "id" => $this->id,

            "is_best_offer" => $is_best_offer,

            "service_id" => $this->service_id,
            "order" => [
                "id" => $this->order->id,
                "order_code" => $this->order->order_code
            ],
            "captain" => [
                "id" => $this->captain_id,
                "name" => $this->captain->name,
                "profile_image" => $this->captain->profile_image,
                "joint_from" => $this->captain->captain->created_at->format('Y'),
                "rate" => DB::table("rates")->where("model_type", User::class)->where("model_id", $this->user?->id)->average("rate") ?? 0,
                "number_of_orders" => DB::table("orders")->where("captain_id", $this->captain_id)->where("order_status", OrderEnum::DELIVERED)->count(),
            ],

            "captain_lat" => $this->captain_lat,
            "captain_long" => $this->captain_long,
            "distance" => $this->distance,

            "offer_status" => $this->offer_status,
            "price" => $this->price,
            "app_profit_from_captain" => $this->app_profit_from_captain,
            "app_profit_from_user" => $this->app_profit_from_user,
            "offer_total_cost" => $this->offer_total_cost,

            "is_between_governorate_service" => $this->is_between_governorate_service == 1,
            "governorate_from_id" => $this->governorate_from_id,
            "governorate_to_id" => $this->governorate_to_id,
            "between_governorate_date" => $this->between_governorate_date,
        ];
    }
}
