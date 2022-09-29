<?php

namespace App\Http\Resources\Coupon;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "code" => $this->code,
            "type" => $this->type,
            "percentage" => $this->percentage,
            "amount" => $this->amount,
            "quantity" => $this->quantity,
            "quantity_number" => $this->quantity_number,
            "start_at" => Carbon::parse($this->start_at)->format("Y-m-d"),
            "end_at" => Carbon::parse($this->end_at)->format("Y-m-d"),
        ];
    }
}
