<?php

namespace App\Http\Requests\Admin\Nationality;

use Illuminate\Foundation\Http\FormRequest;

class NationalityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "title" => "required|array|min:1",
            "title.ar" => "required|string"
        ];
    }
}
