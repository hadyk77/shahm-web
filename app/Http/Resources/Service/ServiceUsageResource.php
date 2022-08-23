<?php

namespace App\Http\Resources\Service;

use App\Enums\ServiceEnum;
use App\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceUsageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "icon" => Helper::getFirstMediaUrl($this, ServiceEnum::USAGE_ICON)
        ];
    }
}
