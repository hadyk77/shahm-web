<?php

namespace App\Http\Requests\API\Order;

use App\Enums\OrderEnum;
use App\Enums\VerificationOptionEnum;
use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "service_id" => "required|exists:services,id",

            "captain_id" => [
                Rule::requiredIf($this->input('service_id') == 3),
                Rule::exists("users", "id")
                    ->where("status", 1)
                    ->where("captain_status", 1)
            ],

            "between_governorate_service_id" => [
                Rule::requiredIf($this->input('service_id') == 3),
                Rule::exists("between_governorate_services", 'id')->where('captain_id', $this->input("captain_id"))
            ],


            // Order Details
            "order_type" => "required|in:" . implode(",", array_keys(VerificationOptionEnum::relatedOrders())),
            "order_items" => "required|string",

            // Locations
            "drop_off_location" => "required|string",
            "drop_off_location_description" => "nullable|string",
            "drop_off_location_lat" => "required|numeric",
            "drop_off_location_long" => "required|numeric",
            
            "pickup_location_description" => "nullable|string",

            "pickup_location" => [
                Rule::requiredIf($this->input('service_id') != 2),
                "string"
            ],
            "pickup_location_lat" => [
                Rule::requiredIf($this->input('service_id') != 2),
                "numeric"
            ],
            "pickup_location_long" => [
                Rule::requiredIf($this->input('service_id') != 2),
                "numeric"
            ],

            // Payment Details
            "payment_method" => "required|in:" . implode(",", array_keys(OrderEnum::enabledPaymentMethods())),

            "coupon_code" => "nullable|exists:discounts,code",

            "image.*" => Helper::imageRules(true)
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
