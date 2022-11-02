<?php

namespace App\Notifications\Order;

use App\Enums\NotificationEnum;
use App\Models\Order;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;
use Kutia\Larafirebase\Services\Larafirebase;
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
            return (new Larafirebase())->fromRaw([
                'registration_ids' => [$notifiable->device_token],
                'priority' => 'high',
                'notification' => [
                    'title' => __("Hey,") . " " . $notifiable->name,
                    'body' => NotificationEnum::notificationTypes()[NotificationEnum::NEW_ORDER_REQUEST],
                    "sound" => "default",
                ],
            ])->send();
        }
    }
}
