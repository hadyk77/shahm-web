<?php

namespace App\Http\Resources\Notification;

use App\Enums\NotificationEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title($this->data),
            "content" => $this->content($this->data),
            "is_read" => $this->read_at != null,
            "read_at" => $this->read_at?->format('Y-m-d H:i:s'),
        ];
    }


    private function title($data)
    {
        if ($data['type'] == NotificationEnum::USER_CUSTOM_MESSAGE) {
            return $data["title"];
        }
        return NotificationEnum::notificationTypes()[$data['type']];
    }

    private function content($data)
    {
        if ($data['type'] == NotificationEnum::USER_CUSTOM_MESSAGE) {
            return $data["body"];
        }
        $order = $data["order"];
        return NotificationEnum::notificationTypes()[$data['type']] . " " . __("With Code") . " #" . $order["order_code"];
    }
}
