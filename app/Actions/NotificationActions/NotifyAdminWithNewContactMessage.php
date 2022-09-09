<?php

namespace App\Actions\NotificationActions;

use App\Models\Admin;
use App\Notifications\User\ContactNotification;
use Lorisleiva\Actions\Concerns\AsAction;

class NotifyAdminWithNewContactMessage
{
    use AsAction;

    public function handle($contact)
    {
        $admins = Admin::query()->where("status", 1)->get();

        $admins->map(function (Admin $admin) use ($contact) {
            if ($admin->hasPermissionTo("contact_us")) {
                $admin->notify(new ContactNotification($contact));
            }
        });

    }

}
