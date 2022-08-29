<?php

namespace App\Http\Controllers\API\V1\Discount;

use App\Enums\DiscountEnum;
use App\Http\Controllers\Controller;
use App\Services\Discount\DiscountServices;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function __construct(protected readonly DiscountServices $discountServices)
    {

    }

    public function randomDiscount()
    {
        $discount = $this->discountServices->randomOne();
        if (!is_null($discount)) {
            return $this::sendSuccessResponse([
                "code" => $discount->code,
                "type" => $discount->type,
                "value" => $discount->type == DiscountEnum::PERCENTAGE ? $discount->percentage : $discount->amount,
            ]);
        }
        return $this::sendSuccessResponse([], __("There is no discount"));
    }
}
