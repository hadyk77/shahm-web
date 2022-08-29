<?php

namespace App\Http\Requests\Admin\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title" => "required|array|min:1",
            "title.*" => "required|string"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
