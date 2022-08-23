<?php

namespace App\Models;

use App\Enums\IntroImagesEnum;
use App\Traits\HasTranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class IntroImages extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslationTrait;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(IntroImagesEnum::IMAGE)->singleFile();
    }
}
