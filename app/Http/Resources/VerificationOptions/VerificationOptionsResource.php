<?php

namespace App\Http\Resources\VerificationOptions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VerificationOptionsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "related_orders" => $this->related_orders,
            "description" => $this->description,
            "icon" => $this->icon,
            "active_icon" => $this->active_icon,
            "purchase_link" => $this->purchase_link,
            "sale_link" => $this->sale_link,
        ];
    }
}
