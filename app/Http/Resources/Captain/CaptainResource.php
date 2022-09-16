<?php

namespace App\Http\Resources\Captain;

use App\Http\Resources\Nationality\NationalityResource;
use App\Http\Resources\VehicleType\VehicleTypeResource;
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
        ];
    }
}
