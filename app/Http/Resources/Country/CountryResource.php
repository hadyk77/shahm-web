<?php

namespace App\Http\Resources\Country;

use App\Enums\CountryEnum;
use App\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "flag" => Helper::getFirstMediaUrl($this, CountryEnum::FLAG),
            "country_code" => $this->country_code
        ];
    }
}
