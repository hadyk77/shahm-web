<?php

namespace App\Models;

use App\Enums\ProfileImageEnum;
use App\Traits\HasProfileImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

}
