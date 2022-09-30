<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Offer
 *
 * @property int $id
 * @property int $service_id
 * @property int $user_id
 * @property int|null $captain_id
 * @property string $message
 * @property float $price
 * @property string $offer_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereOfferStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUserId($value)
 * @mixin \Eloquent
 */
class Offer extends Model
{
    use HasFactory;

    public function captain(): BelongsTo
    {
        return $this->belongsTo(User::class, "captain_id");
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, "order_id");
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, "service_id");
    }
}
