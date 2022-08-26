<?php

namespace App\Http\Requests\Admin\Governorate;

use Illuminate\Foundation\Http\FormRequest;

class GovernorateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title" => "required|array|min:1",
            'title.ar' => "required|string",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
