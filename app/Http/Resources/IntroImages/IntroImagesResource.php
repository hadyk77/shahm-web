<?php

namespace App\Http\Resources\IntroImages;

use App\Enums\IntroImagesEnum;
use App\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class IntroImagesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "image" => Helper::getFirstMediaUrl($this, IntroImagesEnum::IMAGE),
        ];
    }
}
