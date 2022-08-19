<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Captain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Captain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Captain query()
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereVehicleIdentificationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereVehicleLicensePlateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereVehicleManufacturingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereVehicleNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Captain whereVehicleTypeId($value)
 * @mixin \Eloquent
 */
class Captain extends Model
{
    use HasFactory;
}
