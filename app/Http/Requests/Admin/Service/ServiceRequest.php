<?php

namespace App\Http\Requests\Admin\Service;

use App\Helper\Helper;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            "service_usage" => "required|array|min:1",
            "service_usage.*.title" => "required|string",
            "service_usage.*.description" => "required|string",
            "service_usage.*.icon" => Helper::imageRules(true),
        ];
    }
}
