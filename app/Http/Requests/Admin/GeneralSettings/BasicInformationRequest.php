<?php

namespace App\Http\Requests\Admin\GeneralSettings;

use Illuminate\Foundation\Http\FormRequest;

class BasicInformationRequest extends FormRequest
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
