<?php

namespace App\Notifications\Chat;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Services\Larafirebase;

class ChatMessageNotification extends Notification
{
    use Queueable;

    public $title;
    public $body;
    private $order_id;

    public function __construct($title, $body, $order_id)
    {
        //
        $this->title = $title;
        $this->body = $body;

        $this->order_id = $order_id;
    }

    public function via($notifiable)
    {
        return ['firebase'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toFirebase($notifiable)
    {
        if (!is_null($notifiable->device_token)) {
            return (new Larafirebase())->fromRaw([
                'registration_ids' => [$notifiable->device_token],
                'data' => [
                    'payload' => [
                        "order_id" => $this->order_id,
                    ]
                ],
                'priority' => 'high',
                'notification' => [
                    'title' => $this->title,
                    'body' => $this->body,
                    "sound" => "default",
                ],
            ])->send();
        }
    }

}
