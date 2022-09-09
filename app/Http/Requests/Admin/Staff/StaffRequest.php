<?php

namespace App\Http\Requests\Admin\Staff;

use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            "name" => "required|string|max:50",
            "email" => "required|string|max:50|unique:admins,email",
            "username" => "required|string|max:50|unique:admins,username",
            "password" => "required|confirmed|min:8",
            "role" => "required|exists:roles,name",
            "user_profile_image" => "nullable|mimetypes:" . implode(",", Media::$IMAGES_MIMES_TYPES),
        ];
        if ($this->getMethod() == "PUT") {
            $rules ["email"] = "required|string|max:50|unique:admins,email," . $this->route("staff");
            $rules ["username"] = "required|string|max:50|unique:admins,username," . $this->route("staff");
            $rules ["password"] = "nullable|confirmed|min:8";
        }
        return $rules;
    }
}
