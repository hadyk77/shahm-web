<?php

namespace App\Models;

use App\Enums\GeneralSettingEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereFacebookLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereFcmKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereFirebaseApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereFirebaseAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereFirebaseAuthDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereFirebaseDatabaseUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereFirebaseMessagingSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereFirebaseProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereFirebaseStorageBucket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereFirstEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereFirstPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereInstagramLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereLinkedinLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereSecondEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereSecondPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereSnapchatLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereTiktokLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereTwitterLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GeneralSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    public array $translatable = [
        "title",
        "description"
    ];

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
