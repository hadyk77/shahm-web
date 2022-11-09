<?php

namespace App\Notifications\Order;

use App\Enums\NotificationEnum;
use App\Models\Offer;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;
use Kutia\Larafirebase\Services\Larafirebase;

class OfferAcceptedNotification extends Notification
{
    public Offer $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function via($notifiable): array
    {
        return ['database', 'firebase'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            "type" => NotificationEnum::OFFER_ACCEPTED,
            "offer" => $this->offer,
            "order_code" => $this->offer->order->order_code,
            "notification_from_id" => $this->offer->user_id,
            "order_id" => $this->offer->order->id,
            "client_id" => $this->offer->order->user_id,
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
                        "order_id" => $this->offer->order_id,
                        "client_id" => $this->offer->order->user_id,
                    ]
                ],
                'notification' => [
                    'title' => __("Hey,") . " " . $notifiable->name,
                    'body' => NotificationEnum::notificationTypes()[NotificationEnum::OFFER_ACCEPTED],
                    "sound" => "default",
                ],
            ])->send();
        }
    }
}
