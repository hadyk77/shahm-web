<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Chat
 *
 * @property int $id
 * @property string $uuid
 * @property int $client_id
 * @property int $captain_id
 * @property int $order_id
 * @property int $service_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $captain
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ChatMessage[] $chatMessages
 * @property-read int|null $chat_messages_count
 * @property-read \App\Models\User $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ChatMessage[] $messages
 * @property-read int|null $messages_count
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Service $service
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUuid($value)
 * @mixin \Eloquent
 */
class Chat extends Model
{
    use HasFactory;

    public function chatMessages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, "client_id");
    }

    public function captain(): BelongsTo
    {
        return $this->belongsTo(User::class, "captain_id");
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, "order_id");
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, "service_id");
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }
}
