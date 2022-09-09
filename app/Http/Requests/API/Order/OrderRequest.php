<?php

namespace App\Http\Requests\API\Order;

use App\Enums\OrderEnum;
use App\Enums\VerificationOptionEnum;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "service_id" => "required|exists:services,id",

            // Order Details
            "order_type" => "required|in:" . implode(",", array_keys(VerificationOptionEnum::relatedOrders())),
            "order_items" => "required|string",

            // Locations
            "drop_off_location" => "required|string",
            "drop_off_location_lat" => "required|numeric",
            "drop_off_location_long" => "required|numeric",
            "pickup_location" => "required|string",
            "pickup_location_lat" => "required|numeric",
            "pickup_location_long" => "required|numeric",

            // Payment Details
            "payment_method" => "required|in:" . implode(",", OrderEnum::enabledPaymentMethods()),
            "coupon_code" => "nullable|exists:discounts,code",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
