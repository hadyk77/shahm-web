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
 * @property int $order_id
 * @property float|null $captain_lat
 * @property float|null $captain_long
 * @property float|null $distance
 * @property float $app_profit_from_captain
 * @property float $app_profit_from_user
 * @property float $offer_total_cost
 * @property int $is_between_governorate_service
 * @property int|null $governorate_from_id
 * @property int|null $governorate_to_id
 * @property string|null $between_governorate_date
 * @property-read \App\Models\User $captain
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Service $service
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereAppProfitFromCaptain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereAppProfitFromUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereBetweenGovernorateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCaptainLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCaptainLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereGovernorateFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereGovernorateToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereIsBetweenGovernorateService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereOfferTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereOrderId($value)
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
