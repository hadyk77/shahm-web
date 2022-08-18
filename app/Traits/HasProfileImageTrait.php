<?php

namespace App\Traits;

use App\Enums\ProfileImageEnum;
use App\Models\GeneralSetting;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasProfileImageTrait
{
    public function profileImage(): Attribute
    {
        return Attribute::get(function () {

            if ($this->hasMedia(ProfileImageEnum::PROFILE_IMAGE)) {

                return $this->getFirstMediaUrl(ProfileImageEnum::PROFILE_IMAGE);

            }

            return GeneralSetting::query()->first()->default_profile_image;
        });
    }
}
