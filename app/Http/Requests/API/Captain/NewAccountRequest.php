<?php

namespace App\Http\Requests\API\Captain;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;

class NewAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "nationality_id" => 'nullable|exists:nationalities,id',
            "governorate_id" => 'nullable|exists:governorates,id',
            "vehicle_type_id" => "required|exists:vehicle_types,id",
            "vehicle_manufacturing_date" => "required|string",
            "wallet_number" => "required|string",
//            "vehicle_number" => "required|string",
            "vehicle_identification_number" => "required|string",
            "vehicle_license_plate_number" => "required|string",
            "identification_number" => "required|string",
            "license_from_back" => Helper::imageRules(),
            "license_from_front" => Helper::imageRules(),
            "car_picture_from_front" => Helper::imageRules(),
            "car_picture_from_back" => Helper::imageRules(),
            "identification_from_back" => Helper::imageRules(),
            "identification_from_front" => Helper::imageRules(),
            "coronavirus_certificate" => Helper::imageRules(),
            "no_criminal_record_certificate" => Helper::imageRules(),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
