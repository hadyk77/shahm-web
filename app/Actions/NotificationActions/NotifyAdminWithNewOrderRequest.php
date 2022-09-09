<?php

namespace App\Actions\NotificationActions;

use App\Models\Admin;
use App\Notifications\Order\NewOrderNotification;

use Lorisleiva\Actions\Concerns\AsAction;

class NotifyAdminWithNewOrderRequest
{
    use AsAction;

    public function handle($order)
    {
        $admins = Admin::query()->where("status", 1)->get();

        $admins->map(function (Admin $admin) use ($order) {
            if ($admin->hasPermissionTo("orders")) {
                $admin->notify(new NewOrderNotification($order));
            }
        });
    }

}
