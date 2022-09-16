<?php

namespace App\Models;

use App\Notifications\Admin\AdminResetPasswordNotification;
use App\Traits\HasProfileImageTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $username
 * @property string|null $device_token
 * @property int $status
 * @property string|null $last_login_at
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static Builder|Admin newModelQuery()
 * @method static Builder|Admin newQuery()
 * @method static Builder|Admin permission($permissions)
 * @method static Builder|Admin query()
 * @method static Builder|Admin role($roles, $guard = null)
 * @method static Builder|Admin whereCreatedAt($value)
 * @method static Builder|Admin whereDeviceToken($value)
 * @method static Builder|Admin whereEmail($value)
 * @method static Builder|Admin whereEmailVerifiedAt($value)
 * @method static Builder|Admin whereId($value)
 * @method static Builder|Admin whereLastLoginAt($value)
 * @method static Builder|Admin whereName($value)
 * @method static Builder|Admin wherePassword($value)
 * @method static Builder|Admin whereRememberToken($value)
 * @method static Builder|Admin whereStatus($value)
 * @method static Builder|Admin whereUpdatedAt($value)
 * @method static Builder|Admin whereUsername($value)
 * @mixin Eloquent
 */
class Admin extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, HasRoles, HasProfileImageTrait;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
}
