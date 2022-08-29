<?php

namespace App\Models;

use App\Enums\VerificationOptionEnum;
use App\Traits\HasTranslationTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class VerificationOption extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslationTrait;


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(VerificationOptionEnum::ICON)->singleFile();
    }

    public function icon(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(VerificationOptionEnum::ICON);
        });
    }

}
