<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;

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
