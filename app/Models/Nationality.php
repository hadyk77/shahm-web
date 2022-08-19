<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Nationality
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality query()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Nationality extends Model
{
    use HasFactory;
}
