<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Rate
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property int $user_id
 * @property string|null $text
 * @property float $rate
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Rate newModelQuery()
 * @method static Builder|Rate newQuery()
 * @method static Builder|Rate query()
 * @method static Builder|Rate whereCreatedAt($value)
 * @method static Builder|Rate whereId($value)
 * @method static Builder|Rate whereModelId($value)
 * @method static Builder|Rate whereModelType($value)
 * @method static Builder|Rate whereRate($value)
 * @method static Builder|Rate whereText($value)
 * @method static Builder|Rate whereUpdatedAt($value)
 * @method static Builder|Rate whereUserId($value)
 * @mixin Eloquent
 */
class Rate extends Model
{
    use HasFactory;

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
