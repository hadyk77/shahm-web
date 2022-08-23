<?php

namespace App\Http\Resources\GeneralSetting;

use App\Enums\GeneralSettingEnum;
use App\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralSettingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "title" => $this->title,
            "description" => $this->description,
            "logo" => Helper::getFirstMediaUrl($this, GeneralSettingEnum::LOGO_IMAGE),
            "first_email" => $this->first_email,
            "second_email" => $this->second_email,
            "first_phone" => $this->first_phone,
            "second_phone" => $this->second_phone,
            "facebook_link" => $this->facebook_link,
            "twitter_link" => $this->twitter_link,
            "instagram_link" => $this->instagram_link,
            "linkedin_link" => $this->linkedin_link,
            "tiktok_link" => $this->tiktok_link,
            "snapchat_link" => $this->snapchat_link,
        ];
    }

}
