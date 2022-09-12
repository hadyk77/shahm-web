<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Transaction extends Model
{
    use HasFactory, HasTranslationTrait;

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, "done_by");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function captain(): BelongsTo
    {
        return $this->belongsTo(User::class, "captain_id");
    }

}
