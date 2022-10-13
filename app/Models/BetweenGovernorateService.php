<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BetweenGovernorateService extends Model
{
    use HasFactory;

    public function governorateFrom(): BelongsTo
    {
        return $this->belongsTo(Governorate::class, "pickup_id");
    }

    public function governorateTo(): BelongsTo
    {
        return $this->belongsTo(Governorate::class, "drop_off_id");
    }

    public function captain(): BelongsTo
    {
        return $this->belongsTo(User::class,"captain_id");
    }

}
