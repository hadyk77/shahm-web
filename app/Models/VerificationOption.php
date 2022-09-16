<?php

namespace App\Models;

use App\Enums\VerificationOptionEnum;
use App\Traits\HasTranslationTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\VerificationOption
 *
 * @property int $id
 * @property array $title
 * @property array|null $description
 * @property int $status
 * @property int $is_deletable
 * @property string $related_orders
 * @property string|null $purchase_link
 * @property string|null $sale_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption whereIsDeletable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption wherePurchaseLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption whereRelatedOrders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption whereSaleLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class VerificationOption extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslationTrait;


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(VerificationOptionEnum::ICON)->singleFile();
        $this->addMediaCollection(VerificationOptionEnum::ICON_ACTIVE)->singleFile();
    }

    public function icon(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(VerificationOptionEnum::ICON);
        });
    }

    public function activeIcon(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(VerificationOptionEnum::ICON_ACTIVE);
        });
    }

}
