<?php

namespace App\Notifications;

use App\Enums\NotificationEnum;
use App\Models\Contact;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class ContactNotification extends Notification
{
    private Contact $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function via($notifiable): array
    {
        return ['database', "firebase"];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable): array
    {
        return [
            "type" => NotificationEnum::NEW_CONTACT_MESSAGE,
            "contact" => $this->contact,
        ];
    }

    public function toFirebase($notifiable)
    {
        if (!is_null($notifiable->device_token)) {
            return (new FirebaseMessage)
                ->withTitle(__("Hey,") . " " . $notifiable->name)
                ->withBody(NotificationEnum::notificationTypes()[NotificationEnum::NEW_CONTACT_MESSAGE])
                ->asMessage($notifiable->device_token);
        }
    }
}
