<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\CaptainService
 *
 * @property int $id
 * @property int $service_id
 * @property int $captain_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|CaptainService newModelQuery()
 * @method static Builder|CaptainService newQuery()
 * @method static Builder|CaptainService query()
 * @method static Builder|CaptainService whereCaptainId($value)
 * @method static Builder|CaptainService whereCreatedAt($value)
 * @method static Builder|CaptainService whereId($value)
 * @method static Builder|CaptainService whereServiceId($value)
 * @method static Builder|CaptainService whereUpdatedAt($value)
 * @mixin Eloquent
 */
class CaptainService extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
}
