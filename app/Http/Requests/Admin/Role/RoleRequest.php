<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "permissions" => "required|array|min:1",
            "permissions.*" => "required|string|exists:permissions,name",
        ];
    }
}
