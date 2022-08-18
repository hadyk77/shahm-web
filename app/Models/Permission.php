<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    use HasTranslationTrait;
}
