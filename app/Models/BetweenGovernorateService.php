<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\BetweenGovernorateService
 *
 * @property int $id
 * @property int $captain_id
 * @property int|null $pickup_id
 * @property int|null $drop_off_id
 * @property string|null $between_governorate_time
 * @property string|null $between_governorate_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $captain
 * @property-read \App\Models\Governorate|null $governorateFrom
 * @property-read \App\Models\Governorate|null $governorateTo
 * @method static \Illuminate\Database\Eloquent\Builder|BetweenGovernorateService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BetweenGovernorateService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BetweenGovernorateService query()
 * @method static \Illuminate\Database\Eloquent\Builder|BetweenGovernorateService whereBetweenGovernorateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetweenGovernorateService whereBetweenGovernorateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetweenGovernorateService whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetweenGovernorateService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetweenGovernorateService whereDropOffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetweenGovernorateService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetweenGovernorateService wherePickupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BetweenGovernorateService whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BetweenGovernorateService extends Model
{
    use HasFactory;

    public function governorateFrom(): BelongsTo
    {
        return $this->belongsTo(Governorate::class, "pickup_id");
    }

    public function governorateTo(): BelongsTo
    {
        return $this->belongsTo(Governorate::class, "drop_off_id");
    }

    public function captain(): BelongsTo
    {
        return $this->belongsTo(User::class,"captain_id");
    }

}
