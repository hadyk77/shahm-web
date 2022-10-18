<?php

namespace App\Notifications\Order;

use App\Enums\NotificationEnum;
use App\Models\Offer;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class OfferRejectedNotification extends Notification
{
    private Offer $offer;

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
            "type" => NotificationEnum::OFFER_REJECTED,
            "offer" => $this->offer,
            "order_code" => $this->offer->order->order_code,
            "notification_from_id" => $this->offer->user_id,
        ];
    }

    public function toFirebase($notifiable)
    {
        if (!is_null($notifiable->device_token)) {
            return (new FirebaseMessage)
                ->withTitle(__("Hey,") . " " . $notifiable->name)
                ->withBody(NotificationEnum::notificationTypes()[NotificationEnum::OFFER_REJECTED])
                ->asMessage($notifiable->device_token);
        }
    }
}
