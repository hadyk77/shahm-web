<?php

namespace App\Http\Requests\Admin\Banner;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            "order" => "nullable|numeric",
            "image" => Helper::imageRules($this->isMethod("PUT"))
        ];
    }
}
