<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\VehicleType
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|VehicleType newModelQuery()
 * @method static Builder|VehicleType newQuery()
 * @method static Builder|VehicleType query()
 * @method static Builder|VehicleType whereCreatedAt($value)
 * @method static Builder|VehicleType whereId($value)
 * @method static Builder|VehicleType whereStatus($value)
 * @method static Builder|VehicleType whereTitle($value)
 * @method static Builder|VehicleType whereUpdatedAt($value)
 * @mixin Eloquent
 */
class VehicleType extends Model
{
    use HasFactory, HasTranslationTrait;
}
