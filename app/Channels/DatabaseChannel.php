<?php

namespace App\Channels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Channels\DatabaseChannel as IlluminateDatabaseChannel;

class DatabaseChannel extends IlluminateDatabaseChannel
{
    public function send($notifiable, Notification $notification): Model
    {
        return $notifiable->routeNotificationFor('database')->create([
            'id' => $notification->id,
            'type' => get_class($notification),
            'for_captain' => (bool)$notifiable->is_captain,
            'data' => $this->getData($notifiable, $notification),
            'read_at' => null,
        ]);
    }
}
