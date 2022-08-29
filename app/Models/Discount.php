<?php

namespace App\Models;

use App\Enums\DiscountEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
