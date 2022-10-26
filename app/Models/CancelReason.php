<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CancelReason
 *
 * @property int $id
 * @property array $title
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CancelReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CancelReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CancelReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|CancelReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancelReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancelReason whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancelReason whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CancelReason whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CancelReason extends BaseModel
{
    use HasTranslationTrait;
}
