<?php

namespace App\Http\Resources\Order;

use App\Enums\OfferEnum;
use App\Helper\Helper;
use App\Models\Captain;
use App\Models\User;
use App\Support\CalculateDistanceBetweenTwoPoints;
use Auth;
use DB;
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
            "has_chat" => DB::table("chats")->where("order_id", $this->id)->exists(),
            "items_price" => $this->items_price,
            "captain_profit" => $this->captain_profit,
            "app_profit_from_captain" => $this->app_profit_from_captain,
            "app_profit_from_user" => $this->app_profit_from_user,
            "delivery_cost_with_user_commission" => $this->delivery_cost_with_user_commission,
            "delivery_cost_without_user_commission" => $this->delivery_cost_without_user_commission,
            "grand_total" => $this->grand_total,
            "tax" => $this->tax,
            "captain" => $this->mergeWhen(!Helper::isCaptain($this) && $this->captain_id != null, function () {
                $rate = DB::table("rates")
                    ->where("model_type", Captain::class)
                    ->where("model_id", $this->captain?->captain?->id)
                    ->where("order_id", $this->id)->first();
                return [
                    "id" => $this->captain->id,
                    "captain_id" => $this->captain?->captain?->id,
                    "name" => $this->captain->name,
                    "image" => $this->captain->profile_image,
                    "captain_rate" => $rate?->rate ?? 0,
                    "rate_text" => $rate?->text ?? "",
                ];
            }),
            "client" => $this->mergeWhen(Helper::isCaptain($this), function () {
                $rate = DB::table("rates")
                    ->where("model_type", User::class)
                    ->where("model_id", $this->user_id)
                    ->where("user_id", Auth::id())
                    ->where("order_id", $this->id)->first();
                return [
                    "id" => $this->client->id,
                    "name" => $this->client->name,
                    "image" => $this->client->profile_image,
                    "captain_rate" => $rate?->rate ?? 0,
                    "rate_text" => $rate?->text ?? "",
                    "email" => $this->client->email,
                    "user_rate" => DB::table("rates")->where("model_id", $this->client->id)->average("rate") ?? 0,
                ];
            }),
            'distance' => $this->merge(function () {
                return [
                    "drop_off_distance" => Helper::getLocationDetailsFromGoogleMapApi(
                        Auth::user()->address_lat,
                        Auth::user()->address_long,
                        $this->drop_off_location_lat,
                        $this->drop_off_location_long
                    )["distanceValue"],
                    "pickup_distance" => $this->service_id == 2 ? 0 : Helper::getLocationDetailsFromGoogleMapApi(
                        Auth::user()->address_lat,
                        Auth::user()->address_long,
                        $this->pickup_location_lat,
                        $this->pickup_location_long
                    )["distanceValue"],
                ];
            }),
            "order_status" => $this->order_status,
            "order_items" => $this->order_items,
            "drop_off_location" => $this->drop_off_location,
            "captain_make_offer_before" => $this->mergeWhen(Helper::isCaptain($this), function () {

                $oldOfferStatuses = DB::table("offers")
                    ->where("captain_id", Auth::id())
                    ->where("order_id", $this->id)
                    ->pluck("offer_status")
                    ->toArray();

                if (in_array(OfferEnum::PENDING, $oldOfferStatuses)) {
                    return true;
                }

                if (in_array(OfferEnum::ACCEPTED, $oldOfferStatuses)) {
                    return true;
                }

                return false;
            }),
            "created_at" => Helper::formatDate($this->created_at)
        ];
    }
}
