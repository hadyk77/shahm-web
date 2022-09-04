<?php

namespace App\Http\Requests\Admin\Captain;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CaptainRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "user_id" => [
                Rule::requiredIf(!$this->isMethod("PUT")),
                Rule::exists("users", "id")->where("is_captain", false),
            ],
            "vehicle_type_id" => "required|exists:vehicle_types,id",
            "vehicle_manufacturing_date" => "required",
            "vehicle_number" => "required",
            "vehicle_identification_number" => "required",
            "vehicle_license_plate_number" => "required",
            "license_from_back" => Helper::imageRules($this->isMethod("PUT")),
            "license_from_front" => Helper::imageRules($this->isMethod("PUT")),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
