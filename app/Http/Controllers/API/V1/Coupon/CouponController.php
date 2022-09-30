<?php

namespace App\Http\Controllers\API\V1\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Resources\Coupon\CouponResource;
use App\Services\Discount\DiscountServices;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct(private readonly DiscountServices $discountServices)
    {
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            "code" => "required"
        ]);

        $coupon = $this->discountServices->checkIfCouponIsVerified($request->code);

        if (is_null($coupon)) {
            return $this::sendFailedResponse(__("Coupon not valid"));
        }
        return $this::sendSuccessResponse([
            "is_valid" => true,
            "coupon" => CouponResource::make($coupon),
        ], __("Coupon valid"));
    }
}
