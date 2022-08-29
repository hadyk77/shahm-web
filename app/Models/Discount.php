<?php

namespace App\Models;

use App\Enums\DiscountEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $casts = [
        "start_date" => "datetime:Y-m-d",
        "end_date" => "datetime:Y-m-d",
        "amount" => "float"
    ];

    public function discountAmount(float $cartAmount): float
    {
        if ($this->type == DiscountEnum::PERCENTAGE) {
            return ($this->percentage / 100) * $cartAmount;
        }
        return $this->amount;
    }

}
