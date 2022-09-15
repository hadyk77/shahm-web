<?php

namespace App\Http\Resources\ExpectedPriceRange;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpectedPriceRangeResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "kilometer_from" => $this->kilometer_from,
            "kilometer_to" => $this->kilometer_to,
            "price_from" => $this->price_from,
            "price_to" => $this->price_to,
        ];
    }
}
