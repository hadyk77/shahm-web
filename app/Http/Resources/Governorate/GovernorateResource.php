<?php

namespace App\Http\Resources\Governorate;

use Illuminate\Http\Resources\Json\JsonResource;

class GovernorateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            'title' => $this->title,
        ];
    }
}
