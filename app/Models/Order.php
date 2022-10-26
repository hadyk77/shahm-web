<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $service_id
 * @property int $user_id
 * @property int|null $captain_id
 * @property int|null $offer_id
 * @property float|null $items_price
 * @property float|null $delivery_cost
 * @property float $tax
 * @property float $tax_percentage
 * @property float|null $grand_total
 * @property string|null $order_items
 * @property string $payment_method
 * @property string|null $order_code
 * @property string $payment_status
 * @property string $order_status
 * @property string $order_type
 * @property string|null $drop_off_location
 * @property string|null $drop_off_location_lat
 * @property string|null $drop_off_location_long
 * @property string|null $pickup_location
 * @property string|null $pickup_location_lat
 * @property string|null $pickup_location_long
 * @property string|null $discount_code
 * @property string|null $discount_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $captain
 * @property-read \App\Models\User $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderHistory[] $histories
 * @property-read int|null $histories_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Service $service
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDiscountCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDropOffLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDropOffLocationLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDropOffLocationLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereGrandTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereItemsPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePickupLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePickupLocationLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePickupLocationLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTaxPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 * @property int|null $between_governorate_service_id
 * @property int|null $expected_price_range_id
 * @property float|null $app_profit_from_captain
 * @property float|null $app_profit_from_user
 * @property float|null $captain_profit
 * @property float|null $delivery_cost_with_user_commission
 * @property float|null $delivery_cost_without_user_commission
 * @property string|null $drop_off_description
 * @property string|null $pickup_description
 * @property float|null $distance
 * @property string|null $cancel_reason
 * @property-read \App\Models\BetweenGovernorateService|null $betweenGovernorateService
 * @property-read \App\Models\Chat|null $chat
 * @property-read \App\Models\ExpectedPriceRange|null $expectedPriceRange
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $offers
 * @property-read int|null $offers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAppProfitFromCaptain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAppProfitFromUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereBetweenGovernorateServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCaptainProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryCostWithUserCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryCostWithoutUserCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDropOffDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereExpectedPriceRangeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePickupDescription($value)
 */
class Order extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $casts = [
        "drop_off_location_lat" => "float",
        "drop_off_location_long" => "float",
        "pickup_location_lat" => "float",
        "pickup_location_long" => "float",
    ];

    public function captain(): BelongsTo
    {
        return $this->belongsTo(User::class, "captain_id");
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(OrderHistory::class);
    }

    public function expectedPriceRange(): BelongsTo
    {
        return $this->belongsTo(ExpectedPriceRange::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function betweenGovernorateService(): BelongsTo
    {
        return $this->belongsTo(BetweenGovernorateService::class);
    }

    public function chat(): HasOne
    {
        return $this->hasOne(Chat::class, "order_id");
    }
}
