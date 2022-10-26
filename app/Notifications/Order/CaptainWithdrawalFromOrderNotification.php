<?php

namespace App\Notifications\Order;

use App\Models\Order;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Services\Larafirebase;

class CaptainWithdrawalFromOrderNotification extends Notification
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable): array
    {
        return ['firebase'];
    }

    public function toFirebase($notifiable)
    {
        if (!is_null($notifiable->device_token)) {
            return (new Larafirebase())->fromRaw([
                'registration_ids' => [$notifiable->device_token],
                'data' => [
                    'payload' => [
                        "order_id" => $this->order->id,
                    ]
                ],
                'priority' => 'high',
                'notification' => [
                    'title' => __("Captain Withdrawal from order"),
                    'body' => __("Order Code :") . " " . $this->order->order_code,
                    "sound" => "default",
                ],
            ])->send();
        }
    }
}
