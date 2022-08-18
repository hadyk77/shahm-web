<?php

namespace App\Models;

use App\Enums\GeneralSettingEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class GeneralSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    public array $translatable = [
        "title",
        "description"
    ];

    public function logo(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->getFirstMediaUrl(GeneralSettingEnum::LOGO_IMAGE);
        });
    }

    public function defaultProfileImage(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->getFirstMediaUrl(GeneralSettingEnum::DEFAULT_PROFILE_IMAGE);
        });
    }
}
