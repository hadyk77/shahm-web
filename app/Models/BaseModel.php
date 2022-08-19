<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 * @mixin \Eloquent
 */
class BaseModel extends Model
{

    public function ScopeEnabled($query)
    {
        return $query->where('status', StatusEnum::ENABLED);
    }

    public function ScopeDeactivated($query)
    {
        return $query->where('status', StatusEnum::DISABLED);
    }

    public function ScopeUnavailable($query)
    {
        return $query->where('is_available', StatusEnum::DISABLED);
    }
}
