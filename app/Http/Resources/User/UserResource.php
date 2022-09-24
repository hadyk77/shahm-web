<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Captain\CaptainResource;
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
            "is_phone_verified" => !is_null($this->phone_verified_at),
            'captain' => $this->is_captain ? CaptainResource::make($this->captain) : null,
        ];
    }
}
