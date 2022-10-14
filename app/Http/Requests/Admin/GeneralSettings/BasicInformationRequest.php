<?php

namespace App\Http\Requests\Admin\GeneralSettings;

use Illuminate\Foundation\Http\FormRequest;

class BasicInformationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title" => "required|array|min:1",
            "title.ar" => "required|string",
            "description" => "required|array|min:1",
            "description.ar" => "required|string",
            "first_email" => "required",
            "second_email" => "nullable",
            "first_phone" => "required",
            "second_phone" => "nullable",
            "tax" => "required|numeric",
            "max_radius" => "required|numeric",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
