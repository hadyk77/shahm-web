<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use HasTranslationTrait;
}
