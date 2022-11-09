<?php

namespace App\Notifications\Order;

use App\Enums\NotificationEnum;
use App\Models\Offer;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;
use Kutia\Larafirebase\Services\Larafirebase;

class NewOfferNotification extends Notification
{
    private Offer $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
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
                        "order_id" => $this->offer->order_id,
                        "client_id" => $this->offer->order->user_id
                    ]
                ],
                'priority' => 'high',
                'notification' => [
                    'title' => __("Hey,") . " " . $notifiable->name,
                    'body' => NotificationEnum::notificationTypes()[NotificationEnum::NEW_OFFER],
                    "sound" => "default",
                ],
            ])->send();
        }
    }
}
