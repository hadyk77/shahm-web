<?php

namespace App\Http\Resources\Chat;

use App\Enums\OrderEnum;
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
            "client" => [
                "id" => $this->client->id,
                "name" => $this->client->name,
            ],
            "captain" => [
                "id" => $this->captain->id,
                "name" => $this->captain->name,
            ],
            "order" => [
                "id" => $this->order->id,
                "code" => $this->order->order_code,
            ],
            "service" => [
                "id" => $this->service->id,
                "title" => $this->service->title,
            ],
            "chat_is_disabled" => in_array($this->order->order_status, [OrderEnum::CANCELED, OrderEnum::DELIVERED]),
            "is_captain_send_invoice" => $this->is_captain_send_invoice == 1,
            "is_client_pay_invoice" => $this->is_client_pay_invoice == 1,
            "created_at" => Helper::formatDate($this->created_at),
        ];
    }
}
