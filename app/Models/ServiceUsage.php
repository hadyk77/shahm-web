<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServiceUsage
 *
 * @property int $id
 * @property int $service_id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUsage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUsage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUsage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUsage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUsage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUsage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUsage whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUsage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUsage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceUsage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ServiceUsage extends Model
{
    use HasFactory;
}
