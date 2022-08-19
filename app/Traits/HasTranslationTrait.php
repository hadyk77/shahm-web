<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Translatable\HasTranslations;

trait HasTranslationTrait
{
    use HasTranslations;

    public array $translatable = [
        "title",
        "description",
        "name",
    ];

    
    public function name(): Attribute
    {
        return Attribute::get(fn() => $this->translate("name", "ar"));
    }

    public function description(): Attribute
    {
        return Attribute::get(fn() => $this->translate("title", "ar"));
    }
}
