<?php

namespace App\Http\Requests\Admin\CancelReason;

use Illuminate\Foundation\Http\FormRequest;

class CancelReasonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title" => "required|array|min:1",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
