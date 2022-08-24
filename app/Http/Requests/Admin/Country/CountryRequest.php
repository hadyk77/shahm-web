<?php

namespace App\Http\Requests\Admin\Country;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            "country_code" => "required|string|unique:countries,country_code" . ($this->isMethod("PUT") ? "," . $this->route("country") : ""),
            "flag" => Helper::imageRules($this->isMethod("PUT"))
        ];
    }
}
