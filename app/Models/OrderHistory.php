<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\OrderHistory
 *
 * @property int $id
 * @property int $order_id
 * @property string $type
 * @property array|null $comment
 * @property string|null $order_status
 * @property int $is_client_notified
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|OrderHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderHistory whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderHistory whereIsClientNotified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderHistory whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderHistory whereOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderHistory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
