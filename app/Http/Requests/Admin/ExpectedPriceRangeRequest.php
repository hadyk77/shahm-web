<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExpectedPriceRangeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "kilometer_from" => "required",
            "kilometer_to" => "required|gt:kilometer_from",
            "price_from" => "required|numeric",
            "price_to" => "required|numeric|gt:price_from",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
