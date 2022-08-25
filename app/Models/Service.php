<?php

namespace App\Models;

use App\Enums\ServiceEnum;
use App\Traits\HasTranslationTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Service newModelQuery()
 * @method static Builder|Service newQuery()
 * @method static Builder|Service query()
 * @method static Builder|Service whereCreatedAt($value)
 * @method static Builder|Service whereId($value)
 * @method static Builder|Service whereStatus($value)
 * @method static Builder|Service whereTitle($value)
 * @method static Builder|Service whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Service extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslationTrait;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ServiceEnum::ICON)->singleFile();
    }

    public function serviceUsages(): HasMany
    {
        return $this->hasMany(ServiceUsage::class);
    }

    public function icon(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(ServiceEnum::ICON);
        });
    }
}
