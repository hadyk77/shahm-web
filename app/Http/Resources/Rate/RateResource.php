<?php

namespace App\Http\Resources\Rate;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class RateResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "rate_for" => strtolower(Str::remove("App\\Models\\",  $this->model_type)),
            "rate" => $this->rate,
            "text" => $this->text,
        ];
    }
}
