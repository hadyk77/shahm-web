<?php

namespace App\Models;

use App\Enums\ServiceEnum;
use App\Traits\HasTranslationTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\ServiceUsage
 *
 * @property int $id
 * @property int $service_id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ServiceUsage newModelQuery()
 * @method static Builder|ServiceUsage newQuery()
 * @method static Builder|ServiceUsage query()
 * @method static Builder|ServiceUsage whereCreatedAt($value)
 * @method static Builder|ServiceUsage whereDescription($value)
 * @method static Builder|ServiceUsage whereId($value)
 * @method static Builder|ServiceUsage whereServiceId($value)
 * @method static Builder|ServiceUsage whereStatus($value)
 * @method static Builder|ServiceUsage whereTitle($value)
 * @method static Builder|ServiceUsage whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ServiceUsage extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslationTrait;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ServiceEnum::USAGE_ICON)->singleFile();
    }
}
