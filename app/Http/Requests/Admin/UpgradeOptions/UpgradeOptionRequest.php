<?php

namespace App\Http\Requests\Admin\UpgradeOptions;

use Illuminate\Foundation\Http\FormRequest;

class UpgradeOptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title"  => "required|array|min:1",
            'title.ar' => "required|string",
            "completed_orders_count" => "required|numeric|integer|not_in:0"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
