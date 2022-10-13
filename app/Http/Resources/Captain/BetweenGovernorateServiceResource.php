<?php

namespace App\Http\Resources\Captain;

use App\Http\Resources\Governorate\GovernorateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BetweenGovernorateServiceResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "pickup" => GovernorateResource::make($this->governorateFrom),
            "drop_off" => GovernorateResource::make($this->governorateTo),
            "between_governorate_time" => $this->between_governorate_time,
            "between_governorate_date" => $this->between_governorate_date,
        ];
    }
}
