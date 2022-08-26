<?php

namespace App\Http\Resources\UpgradeOptions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpgradeOptionsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "completed_orders_count" => $this->completed_orders_count,
        ];
    }
}
