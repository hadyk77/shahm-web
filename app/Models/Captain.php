<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Captain
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $vehicle_type_id
 * @property string|null $vehicle_manufacturing_date
 * @property string|null $vehicle_number
 * @property string|null $vehicle_identification_number
 * @property string|null $vehicle_license_plate_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Captain newModelQuery()
 * @method static Builder|Captain newQuery()
 * @method static Builder|Captain query()
 * @method static Builder|Captain whereCreatedAt($value)
 * @method static Builder|Captain whereId($value)
 * @method static Builder|Captain whereUpdatedAt($value)
 * @method static Builder|Captain whereUserId($value)
 * @method static Builder|Captain whereVehicleIdentificationNumber($value)
 * @method static Builder|Captain whereVehicleLicensePlateNumber($value)
 * @method static Builder|Captain whereVehicleManufacturingDate($value)
 * @method static Builder|Captain whereVehicleNumber($value)
 * @method static Builder|Captain whereVehicleTypeId($value)
 * @mixin Eloquent
 */
class Captain extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
