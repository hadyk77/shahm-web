<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Governorate
 *
 * @property int $id
 * @property array $title
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Governorate extends BaseModel
{
    use HasFactory, HasTranslationTrait;
}
