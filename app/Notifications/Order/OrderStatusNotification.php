<?php

namespace App\Notifications\Order;

use App\Enums\NotificationEnum;
use App\Models\Order;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;
use Kutia\Larafirebase\Services\Larafirebase;

class OrderStatusNotification extends Notification
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable): array
    {
        return ['database', 'firebase'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            "type" => NotificationEnum::ORDER_STATUS_CHANGED,
            "order_code" => $this->order->order_code,
            "order_status" => $this->order->order_status,
            "notification_from_id" => $this->order->captain_id,
            "order_id" => $this->order->id,
            "client_id" => $this->order->user_id,
        ];
    }

    public function toFirebase($notifiable)
    {
        if (!is_null($notifiable->device_token)) {
            return (new Larafirebase())->fromRaw([
                'registration_ids' => [$notifiable->device_token],
                'priority' => 'high',
                "data" => [
                    "payload" => [
                        "order_id" => $this->order->id,
                        "client_id" => $this->order->user_id,
                    ]
                ],
                'notification' => [
                    'title' => __("Hey,") . " " . $notifiable->name,
                    'body' => NotificationEnum::notificationTypes()[NotificationEnum::ORDER_STATUS_CHANGED],
                    "sound" => "default",
                ],
            ])->send();
        }
    }
}
