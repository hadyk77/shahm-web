<?php

namespace App\Notifications\Order;

use App\Enums\NotificationEnum;
use App\Models\Order;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;
use Kutia\Larafirebase\Services\Larafirebase;

class OrderReceivedNotification extends Notification
{
    public function __construct(public Order $order)
    {
    }

    public function via($notifiable): array
    {
        return ['database', "firebase"];
    }

    public function toDatabase($notifiable): array
    {
        return [
            "type" => NotificationEnum::YOUR_ORDER_RECEIVED,
            "order" => $this->order,
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
                    'body' => NotificationEnum::notificationTypes()[NotificationEnum::YOUR_ORDER_RECEIVED] . " " . __("and waiting proper offers"),
                    "sound" => "default",
                ],
            ])->send();
        }
    }

}
