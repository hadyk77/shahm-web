<?php

namespace App\Notifications\Order;

use App\Enums\NotificationEnum;
use App\Models\Order;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class OrderCanceledNotification extends Notification
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable): array
    {
        return ['firebase', 'database'];
    }

    public function toArray($notifiable): array
    {
        return [
            "type" => NotificationEnum::ORDER_CANCELED,
            "order" => $this->order,
            "order_code" => $this->order->order_code,
            "notification_from_id" => $this->order->user_id,
        ];
    }

    public function toFirebase($notifiable)
    {
        if (!is_null($notifiable->device_token)) {
            return (new FirebaseMessage)
                ->withTitle(__("Hey,") . " " . $notifiable->name)
                ->withBody(NotificationEnum::notificationTypes()[NotificationEnum::ORDER_CANCELED] . " [ " . $this->order->order_code . " ]")
                ->asMessage($notifiable->device_token);
        }
    }
}
