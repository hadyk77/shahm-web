<?php

namespace App\Http\Resources\Notification;

use App\Enums\NotificationEnum;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "notification_from_image" => null,
            "title" => $this->title($this->data),
            "content" => $this->content($this->data),
            "is_read" => $this->read_at != null,
            "read_at" => $this->read_at?->format('Y-m-d H:i:s'),
            "read_at_for_humans" => $this->read_at?->diffForHumans(),
            "created_at" => Helper::formatDate($this->created_at),
            "created_at_for_humans" => $this->created_at->diffForHumans(),
        ];
    }


    private function title($data): string
    {
        if ($data['type'] == NotificationEnum::USER_CUSTOM_MESSAGE) {
            return $data["title"];
        }
        return NotificationEnum::notificationTypes()[$data['type']];
    }

    private function content($data): string
    {
        if ($data['type'] == NotificationEnum::USER_CUSTOM_MESSAGE) {
            return $data["body"];
        }
        $order = $data["order"];
        return NotificationEnum::notificationTypes()[$data['type']] . " " . __("With Code") . " " . $order["order_code"];
    }
}
