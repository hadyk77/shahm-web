<?php

namespace App\Notifications\User;

use App\Enums\NotificationEnum;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;
use Log;

class UserCustomNotification extends Notification
{
    public function __construct(public string $title, public string $body)
    {
    }

    public function via($notifiable): array
    {
        return ['database', 'firebase'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            "type" => NotificationEnum::USER_CUSTOM_MESSAGE,
            "title" => $this->title,
            "body" => $this->body,
        ];
    }

    public function toArray($notifiable): array
    {
        return [];
    }

    public function toFirebase($notifiable)
    {
        if (!is_null($notifiable->device_token)) {
            Log::info("message send to [$notifiable->name] with token [$notifiable->device_token]");
            return (new FirebaseMessage)
                ->withTitle($this->title)
                ->withBody($this->body)
                ->asMessage($notifiable->device_token);
        }
    }
}
