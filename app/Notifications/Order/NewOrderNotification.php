<?php

namespace App\Notifications\Order;

use App\Enums\NotificationEnum;
use App\Models\Order;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;
use Log;

class NewOrderNotification extends Notification
{
    public function __construct(public Order $order)
    {
    }

    public function via($notifiable): array
    {
        return ['database', 'firebase'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            "type" => NotificationEnum::NEW_ORDER_REQUEST,
            "order" => $this->order,
        ];
    }

    public function toFirebase($notifiable)
    {
        if (!is_null($notifiable->device_token)) {
            Log::info("Captain with name [" . $notifiable->name . "] notified with order with code " . $this->order->order_code);
            return (new FirebaseMessage)
                ->withTitle(__("Hey,") . " " . $notifiable->name)
                ->withBody(NotificationEnum::notificationTypes()[NotificationEnum::NEW_ORDER_REQUEST])
                ->asMessage($notifiable->device_token);
        }
    }
}
