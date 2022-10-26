<?php

namespace App\Models;

use App\Enums\CaptainEnum;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property float $exceed_indebtedness
 * @property string|null $captain_phone_number
 * @property int $is_captain_phone_number_verified
 * @property int $nationality_id
 * @property string $identification_number
 * @property string|null $waller_number
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\User $user
 * @method static Builder|Captain whereCaptainPhoneNumber($value)
 * @method static Builder|Captain whereExceedIndebtedness($value)
 * @method static Builder|Captain whereIdentificationNumber($value)
 * @method static Builder|Captain whereIsCaptainPhoneNumberVerified($value)
 * @method static Builder|Captain whereNationalityId($value)
 * @method static Builder|Captain whereWallerNumber($value)
 * @property string|null $wallet_number
 * @property int $enable_order
 * @property int|null $account_upgrade_option_id
 * @property-read \App\Models\AccountUpgradeOption|null $accountUpgradeOption
 * @property-read \App\Models\Nationality $nationality
 * @property-read \App\Models\VehicleType|null $vehicleType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CaptainVerificationFile[] $verificationFiles
 * @property-read int|null $verification_files_count
 * @method static Builder|Captain whereAccountUpgradeOptionId($value)
 * @method static Builder|Captain whereEnableOrder($value)
 * @method static Builder|Captain whereWalletNumber($value)
 */
class Captain extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(CaptainEnum::LICENSE_PICTURE_FROM_FRONT)->singleFile();
        $this->addMediaCollection(CaptainEnum::LICENSE_PICTURE_FROM_BACK)->singleFile();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }

    public function verificationFiles(): HasMany
    {
        return $this->hasMany(CaptainVerificationFile::class);
    }

    public function accountUpgradeOption(): BelongsTo
    {
        return $this->belongsTo(AccountUpgradeOption::class);
    }
}
