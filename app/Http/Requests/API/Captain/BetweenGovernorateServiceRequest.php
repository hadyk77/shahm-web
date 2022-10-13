<?php

namespace App\Http\Requests\API\Captain;

use Illuminate\Foundation\Http\FormRequest;

class BetweenGovernorateServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "pickup_id" => "required|exists:governorates,id",
            "drop_off_id" => "required|exists:governorates,id",
            "between_governorate_time" => "required|after:today",
            "between_governorate_date" => "required",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
