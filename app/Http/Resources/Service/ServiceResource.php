<?php

namespace App\Http\Resources\Service;

use App\Enums\ServiceEnum;
use App\Helper\Helper;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ServiceResource extends JsonResource
{
    public function toArray($request): array
    {
        return  [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "icon" => Helper::getFirstMediaUrl($this, ServiceEnum::ICON),
            "usages" => ServiceUsageResource::collection($this->serviceUsages)
        ];
    }
}
