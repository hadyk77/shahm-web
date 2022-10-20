<?php

namespace App\Http\Resources\Chat;

use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "uuid" => $this->uuid,
            "client_id" => $this->client_id,
            "captain_id" => $this->captain_id,
            "order_id" => $this->order_id,
            "service_id" => $this->service_id,
            "created_at" => Helper::formatDate($this->created_at),
        ];
    }
}
