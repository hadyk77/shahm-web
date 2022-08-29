<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission as BasePermission;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Permission
 *
 * @property int $id
 * @property array $title
 * @property array $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 * @method static Builder|Permission newModelQuery()
 * @method static Builder|Permission newQuery()
 * @method static Builder|Permission permission($permissions)
 * @method static Builder|Permission query()
 * @method static Builder|Permission role($roles, $guard = null)
 * @method static Builder|Permission whereCreatedAt($value)
 * @method static Builder|Permission whereGuardName($value)
 * @method static Builder|Permission whereId($value)
 * @method static Builder|Permission whereName($value)
 * @method static Builder|Permission whereTitle($value)
 * @method static Builder|Permission whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Permission extends BasePermission
{
    use HasTranslations;

    public array $translatable = [
        "title",
    ];
}
