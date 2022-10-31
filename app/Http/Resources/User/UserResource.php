<?php

namespace App\Http\Resources\User;

use App\Enums\OrderEnum;
use App\Http\Resources\Captain\CaptainResource;
use App\Models\User;
use DB;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
{
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "image" => $this->profile_image,
            "phone" => $this->phone,
            "email" => $this->email,
            "date_of_birth" => $this->date_of_birth,
            "gender" => $this->gender,
            "address" => [
                "location" => $this->address,
                "lat" => $this->address_lat,
                "long" => $this->address_long,
            ],
            "is_captain" => $this->is_captain == 1,
            "app_version" => $this->app_version,
            "default_lang" => $this->default_lang,
            "device_token" => $this->device_token,
            "social_login_type" => $this->social_login_type,
            "social_login_id" => $this->social_login_id,
            "enable_notification" => $this->enable_notification == 1,
            "status" => $this->status,
            "captain_status" => $this->captain_status,
            "is_phone_verified" => !is_null($this->phone_verified_at),
            "user_rate" => DB::table("rates")->where("model_type", User::class)->where("model_id", $this->id)->average("rate") ?? 0,
            "captain_profit" => 0,
            "captain_grand_total" => DB::table("orders")
                ->where("order_status", OrderEnum::DELIVERED)
                ->sum("grand_total") ?? 0,
            'captain' => $this->is_captain ? CaptainResource::make($this->captain) : null,
        ];
    }
}
