<?php

namespace App\Http\Requests\Admin\Profile;

use App\Enums\GuardEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "current_password" => "current_password:" . GuardEnum::ADMIN,
            "password" => "required|min:8|confirmed",
        ];
    }
}
