<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ExpectedPriceRange
 *
 * @property int $id
 * @property float $kilometer_from
 * @property float $kilometer_to
 * @property float $price_from
 * @property float $price_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ExpectedPriceRange newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpectedPriceRange newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpectedPriceRange query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpectedPriceRange whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpectedPriceRange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpectedPriceRange whereKilometerFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpectedPriceRange whereKilometerTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpectedPriceRange wherePriceFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpectedPriceRange wherePriceTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpectedPriceRange whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExpectedPriceRange extends Model
{
    use HasFactory;
}
