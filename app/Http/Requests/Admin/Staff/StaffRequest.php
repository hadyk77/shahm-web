<?php

namespace App\Http\Requests\Staff;

use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            "name" => "required|string|max:50",
            "email" => "required|string|max:50|unique:users,email",
            "username" => "required|string|max:50|unique:users,username",
            "password" => "required|confirmed|min:8",
            "role" => "required|exists:roles,name",
            "user_profile_image" => "nullable|mimetypes:" . implode(",", Media::$IMAGES_MIMES_TYPES),
        ];
        if ($this->getMethod() == "PUT") {
            $rules ["email"] = "required|string|max:50|unique:users,email," . $this->route("admin_staff");
            $rules ["username"] = "required|string|max:50|unique:users,username," . $this->route("admin_staff");
            $rules ["password"] = "nullable|confirmed|min:8";
        }
        return $rules;
    }
}
