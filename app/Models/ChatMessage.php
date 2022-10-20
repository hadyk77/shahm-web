<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ChatMessage extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $casts = [
        "links" => "json"
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, "sender_id");
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, "receiver_id");
    }
}
