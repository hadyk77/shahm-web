<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaptainVerificationFile extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function captain(): BelongsTo
    {
        return $this->belongsTo(Captain::class);
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(VerificationOption::class, "verification_option_id");
    }

}
