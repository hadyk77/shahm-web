<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;

    public function chatMessages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, "client_id");
    }

    public function captain()
    {
        return $this->belongsTo(User::class, "captain_id");
    }

    public function order()
    {
        return $this->belongsTo(Order::class, "order_id");
    }

    public function service()
    {
        return $this->belongsTo(Service::class, "service_id");
    }
}
