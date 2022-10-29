<?php

namespace App\Http\Requests\API\Rate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "model_type" => "required|in:service,user,captain",
            "model_id" => [
                "required",
                Rule::when($this->get("model_type") == "service", "exists:services,id"),
                Rule::when($this->get("model_type") == "user", "exists:users,id"),
                Rule::when($this->get("model_type") == "captain", "exists:captains,id")
            ],
            "order_id" => [
                Rule::when(in_array($this->get("model_type"), ["service", "captain"]), "required|exists:orders,id"),
            ],
            "rate" => "required|max:5",
            "text" => "nullable|string"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
