<?php

namespace App\Http\Requests\Admin\VerificationOptions;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;

class VerificationOptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title" => "required|array|min:1",
            "title.ar" => "required|string",
            "description" => "required|array|min:1",
            "description.ar" => "required|string",
            "icon" => Helper::imageRules($this->isMethod("PUT"))
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
