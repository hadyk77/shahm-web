<?php

namespace App\Http\Resources\Nationality;

use App\Enums\CountryEnum;
use App\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class NationalityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title
        ];
    }
}
