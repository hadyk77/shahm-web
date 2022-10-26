<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\ChatMessage
 *
 * @property int $id
 * @property int $chat_id
 * @property int $sender_id
 * @property int $receiver_id
 * @property string|null $message_text
 * @property string $type
 * @property float|null $lat
 * @property float|null $long
 * @property float|null $delivery_cost
 * @property float|null $delivery_duration
 * @property int $need_style
 * @property int $is_seen
 * @property float|null $delivery_distance
 * @property array|null $links
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $style_type
 * @property-read \App\Models\Chat $chat
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User $receiver
 * @property-read \App\Models\User $sender
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereDeliveryCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereDeliveryDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereDeliveryDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereIsSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereMessageText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereNeedStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereReceiverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereStyleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
