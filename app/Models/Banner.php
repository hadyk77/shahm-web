<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

/**
 * App\Models\Banner
 *
 * @property int $id
 * @property array|null $title
 * @property int $order
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static Builder|Banner newModelQuery()
 * @method static Builder|Banner newQuery()
 * @method static Builder|Banner query()
 * @method static Builder|Banner whereCreatedAt($value)
 * @method static Builder|Banner whereId($value)
 * @method static Builder|Banner whereOrder($value)
 * @method static Builder|Banner whereStatus($value)
 * @method static Builder|Banner whereTitle($value)
 * @method static Builder|Banner whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Banner extends Model implements HasMedia
{
    use HasFactory, HasTranslationTrait, InteractsWithMedia;
}
