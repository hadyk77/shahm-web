<?php

namespace App\Http\Resources\Captain;

use App\Http\Resources\Nationality\NationalityResource;
use App\Http\Resources\UpgradeOptions\UpgradeOptionsResource;
use App\Http\Resources\VehicleType\VehicleTypeResource;
use App\Models\AccountUpgradeOption;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaptainResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "vehicle_type" => VehicleTypeResource::make($this->vehicleType),
            "nationality" => NationalityResource::make($this->nationality),
            "governorate" => NationalityResource::make($this->governorate),
            "vehicle_manufacturing_date" => $this->vehicle_manufacturing_date,
            "vehicle_number" => $this->vehicle_number,
            "vehicle_identification_number" => $this->vehicle_identification_number,
            "vehicle_license_plate_number" => $this->vehicle_license_plate_number,
            "exceed_indebtedness" => $this->exceed_indebtedness == 1,
            "identification_number" => $this->identification_number,
            "wallet_number" => $this->wallet_number,
            "captain_phone_number" => $this->user->captain_phone_number,
            "is_captain_phone_number_verified" => $this->user->is_captain_phone_number_verified == 1,
            "captain_wallet" => doubleval($this->user->captain_wallet),
            "verificationFiles" => VerificationFileResource::collection($this->verificationFiles),

            "captain_rate" => DB::table("rates")->where("model_type", User::class)->where("model_id", $this->user?->id)->average("rate") ?? 0,

            "enable_order" => $this->enable_order,
            "enable_between_governorate_service" => $this->enable_between_governorate_service,
            "pickup_id" => $this->pickup_id,
            "drop_off_id" => $this->drop_off_id,
            "between_governorate_service_time" => $this->between_governorate_time,
            "between_governorate_service_date" => $this->between_governorate_date,

            "account_type" => UpgradeOptionsResource::make($this->accountUpgradeOption)
        ];
    }
}
