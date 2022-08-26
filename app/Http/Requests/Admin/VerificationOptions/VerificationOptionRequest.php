<?php

namespace App\Http\Requests\Admin\VerificationOptions;

use Illuminate\Foundation\Http\FormRequest;

class VerificationOptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
