<?php

namespace App\Http\Requests\Admin\Captain;

use Illuminate\Foundation\Http\FormRequest;

class CaptainRequest extends FormRequest
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
