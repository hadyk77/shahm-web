<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "transaction_type" => $this->transaction_type,
            "transaction_code" => $this->transaction_code,
            "price_amount" => $this->price_amount,
            "is_added_price" => $this->is_added_price,
            "title" => $this->title,
            "notes" => $this->notes,
        ];
    }
}
