<?php

namespace App\Http\Requests\Admin\Profile;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required",
            "email" => "required|email|unique:admins,email," . Auth::id(),
            "username" => "required|alpha_dash|unique:admins,username," . Auth::id()
        ];
    }
}
