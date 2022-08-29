<?php

namespace App\Http\Requests\Admin\Discount;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "code" => "required|string|unique:discounts,code" . ($this->isMethod("PUT") ? ("," . $this->route('discount')) : ""),
            "start_at" => "required|date",
            "end_at" => "required|date",
            "type" => "required|string|in:amount,percentage",
            "amount" => Rule::when(request()->type == "amount", "required|numeric"),
            "percentage" => Rule::when(request()->type == "percentage", "required|numeric|max:100"),
            "quantity" => "required|string|in:limited,unlimited",
            "quantity_number" => Rule::when(request()->quantity == "limited", "required|numeric"),
        ];
    }

}
