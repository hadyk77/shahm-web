<?php

namespace App\Notifications\Order;

use App\Enums\NotificationEnum;
use App\Models\Order;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

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
        ];
    }

    public function toFirebase($notifiable)
    {
        if (!is_null($notifiable->device_token)) {
            return (new FirebaseMessage)
                ->withTitle(__("Hey,") . " " . $notifiable->name)
                ->withBody(NotificationEnum::notificationTypes()[NotificationEnum::NEW_ORDER_REQUEST])
                ->asMessage($notifiable->device_token);
        }
    }
}
