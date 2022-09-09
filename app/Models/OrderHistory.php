<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class OrderHistory extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = [
        "comment"
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

}