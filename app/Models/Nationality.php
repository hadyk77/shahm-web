<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Nationality
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Nationality newModelQuery()
 * @method static Builder|Nationality newQuery()
 * @method static Builder|Nationality query()
 * @method static Builder|Nationality whereCreatedAt($value)
 * @method static Builder|Nationality whereId($value)
 * @method static Builder|Nationality whereStatus($value)
 * @method static Builder|Nationality whereTitle($value)
 * @method static Builder|Nationality whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Nationality extends Model
{
    use HasFactory, HasTranslationTrait;
}
