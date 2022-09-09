<?php

namespace App\Actions\NotificationActions;

use App\Models\User;
use App\Notifications\Order\OrderReceivedNotification;
use Lorisleiva\Actions\Concerns\AsAction;

class NotifyClientWithCreationOfOrderAction
{
    use AsAction;

    public function handle($client, $order)
    {
        $client = User::query()->find($client->id);
        $client->notify(new OrderReceivedNotification($order));
    }

}
