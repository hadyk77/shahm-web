<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CaptainService
 *
 * @property int $id
 * @property int $service_id
 * @property int $captain_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainService query()
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainService whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainService whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainService whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CaptainService extends Model
{
    use HasFactory;
}
