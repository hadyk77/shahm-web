<?php

namespace App\Models;

use App\Enums\DiscountEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Discount
 *
 * @property int $id
 * @property string $code
 * @property string $type
 * @property float|null $percentage
 * @property float|null $amount
 * @property string $quantity
 * @property int|null $quantity_number
 * @property \Illuminate\Support\Carbon $start_at
 * @property \Illuminate\Support\Carbon $end_at
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereQuantityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Discount extends BaseModel
{
    use HasFactory;

    protected $casts = [
        "start_at" => "datetime:Y-m-d",
        "end_at" => "datetime:Y-m-d",
        "amount" => "float",
        "percentage" => "float",
    ];

    public function discountAmount(float $cartAmount): float
    {
        if ($this->type == DiscountEnum::PERCENTAGE) {
            return ($this->percentage / 100) * $cartAmount;
        }
        return $this->amount;
    }

}
