<?php

namespace App\Http\Resources\Banner;

use App\Enums\BannerEnum;
use App\Helper\Helper;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class BannerResource extends JsonResource
{
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "image" => Helper::getFirstMediaUrl($this, BannerEnum::BannerImage),
            "created_at" => Helper::formatDate($this->created_at),
            "updated_at" => Helper::formatDate($this->updated_at),
        ];
    }
}
