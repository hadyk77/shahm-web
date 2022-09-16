<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContactType
 *
 * @property int $id
 * @property array $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContactType extends Model
{
    use HasTranslationTrait;

}
