<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "amount" => "required|numeric",
            "notes" => "nullable|string",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
