<?php

namespace App\Models;

use App\Enums\GeneralSettingEnum;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\GeneralSetting
 *
 * @property int $id
 * @property array $title
 * @property array $description
 * @property string|null $first_email
 * @property string|null $second_email
 * @property string|null $first_phone
 * @property string|null $second_phone
 * @property string|null $facebook_link
 * @property string|null $twitter_link
 * @property string|null $instagram_link
 * @property string|null $linkedin_link
 * @property string|null $snapchat_link
 * @property string|null $tiktok_link
 * @property string|null $fcm_key
 * @property string|null $firebase_api_key
 * @property string|null $firebase_auth_domain
 * @property string|null $firebase_database_url
 * @property string|null $firebase_project_id
 * @property string|null $firebase_storage_bucket
 * @property string|null $firebase_messaging_sender_id
 * @property string|null $firebase_app_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static Builder|GeneralSetting newModelQuery()
 * @method static Builder|GeneralSetting newQuery()
 * @method static Builder|GeneralSetting query()
 * @method static Builder|GeneralSetting whereCreatedAt($value)
 * @method static Builder|GeneralSetting whereDescription($value)
 * @method static Builder|GeneralSetting whereFacebookLink($value)
 * @method static Builder|GeneralSetting whereFcmKey($value)
 * @method static Builder|GeneralSetting whereFirebaseApiKey($value)
 * @method static Builder|GeneralSetting whereFirebaseAppId($value)
 * @method static Builder|GeneralSetting whereFirebaseAuthDomain($value)
 * @method static Builder|GeneralSetting whereFirebaseDatabaseUrl($value)
 * @method static Builder|GeneralSetting whereFirebaseMessagingSenderId($value)
 * @method static Builder|GeneralSetting whereFirebaseProjectId($value)
 * @method static Builder|GeneralSetting whereFirebaseStorageBucket($value)
 * @method static Builder|GeneralSetting whereFirstEmail($value)
 * @method static Builder|GeneralSetting whereFirstPhone($value)
 * @method static Builder|GeneralSetting whereId($value)
 * @method static Builder|GeneralSetting whereInstagramLink($value)
 * @method static Builder|GeneralSetting whereLinkedinLink($value)
 * @method static Builder|GeneralSetting whereSecondEmail($value)
 * @method static Builder|GeneralSetting whereSecondPhone($value)
 * @method static Builder|GeneralSetting whereSnapchatLink($value)
 * @method static Builder|GeneralSetting whereTiktokLink($value)
 * @method static Builder|GeneralSetting whereTitle($value)
 * @method static Builder|GeneralSetting whereTwitterLink($value)
 * @method static Builder|GeneralSetting whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int $is_credit_card_enabled
 * @property int $is_wallet_enabled
 * @property int $is_cash_enabled
 * @property float $client_commission
 * @property float $captain_commission
 * @property float $tax
 * @property float $maximum_indebtedness_for_captain
 * @property float $service_price_per_kilometer
 * @property string $app_version
 * @method static Builder|GeneralSetting whereAppVersion($value)
 * @method static Builder|GeneralSetting whereCaptainCommission($value)
 * @method static Builder|GeneralSetting whereClientCommission($value)
 * @method static Builder|GeneralSetting whereIsCashEnabled($value)
 * @method static Builder|GeneralSetting whereIsCreditCardEnabled($value)
 * @method static Builder|GeneralSetting whereIsWalletEnabled($value)
 * @method static Builder|GeneralSetting whereMaximumIndebtednessForCaptain($value)
 * @method static Builder|GeneralSetting whereServicePricePerKilometer($value)
 * @method static Builder|GeneralSetting whereTax($value)
 * @property string|null $warning_message
 * @property float $max_radius
 * @method static Builder|GeneralSetting whereMaxRadius($value)
 * @method static Builder|GeneralSetting whereWarningMessage($value)
 */
class GeneralSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    public array $translatable = [
        "title",
        "description"
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(GeneralSettingEnum::LOGO_IMAGE)->singleFile();
        $this->addMediaCollection(GeneralSettingEnum::DEFAULT_PROFILE_IMAGE)->singleFile();
    }

    public function logo(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->getFirstMediaUrl(GeneralSettingEnum::LOGO_IMAGE);
        });
    }

    public function defaultProfileImage(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->getFirstMediaUrl(GeneralSettingEnum::DEFAULT_PROFILE_IMAGE);
        });
    }
}
