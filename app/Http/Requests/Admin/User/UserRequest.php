<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required",
            "address" => "required",
            "email" => "required|email:rfc,dns|unique:users,email" . ($this->isMethod("PUT") ? ("," . $this->route("user")) : ""),
            "phone" => "required|string|unique:users,phone" . ($this->isMethod("PUT") ? ("," . $this->route("user")) : ""),
            "date_of_birth" => "required|date",
            "gender" => "required|in:male,female"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
