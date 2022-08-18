<?php

namespace App\Models;

use App\Enums\ProfileImageEnum;
use App\Notifications\User\UserResetPasswordNotification;
use App\Traits\HasProfileImageTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia, HasProfileImageTrait;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ProfileImageEnum::PROFILE_IMAGE)->singleFile();
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // for each branch has one done
    public function domain(): HasOne
    {
        return $this->hasOne(Domain::class, "user_id");
    }

    // for main branch has many branches
    public function domains(): HasMany
    {
        return $this->hasMany(Domain::class, "parent_domain_id");
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }
}
