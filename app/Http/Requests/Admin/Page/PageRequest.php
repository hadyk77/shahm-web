<?php

namespace App\Http\Requests\Admin\Page;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "title" => "required|array|min:1",
            "title.ar" => "required|string",
            "description" => "required|array|min:1",
            "description.ar" => "required|string",
        ];
    }
}
