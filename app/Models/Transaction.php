<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $captain_id
 * @property int|null $order_id
 * @property int|null $done_by
 * @property string $transaction_type
 * @property string $transaction_code
 * @property float $price_amount
 * @property int $is_added_price
 * @property array $title
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admin|null $admin
 * @property-read \App\Models\User|null $captain
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDoneBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereIsAddedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePriceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 * @mixin \Eloquent
 */
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
