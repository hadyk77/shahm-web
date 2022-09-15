<?php

namespace App\Http\Resources\Service;

use App\Enums\ServiceEnum;
use App\Helper\Helper;
use App\Models\Order;
use App\Models\Rate;
use App\Models\Service;
use App\Models\User;
use DB;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ServiceResource extends JsonResource
{
    public function toArray($request): array
    {
        $rates = Rate::query()
            ->where("model_type", Service::class)
            ->where("model_id", $this->id);
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "icon" => Helper::getFirstMediaUrl($this, ServiceEnum::ICON),
            "counts" => $rates->count(),
            "rates" => $rates->average("rate") ?? 0,
            "images" => $rates->get()->map(function (Rate $rate) {
                return $rate->client->profile_image;
            }),
            "usages" => ServiceUsageResource::collection($this->serviceUsages),
        ];
    }
}
