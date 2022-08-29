<?php

namespace App\Actions;

use App\Models\Admin;
use App\Notifications\NewUserRegisteredNotification;
use Lorisleiva\Actions\Concerns\AsAction;

class NotifyAdminsWithNewUserAction
{
    use AsAction;


    public function handle($user)
    {
        $admins = Admin::query()->where("status", 1)->get();

        $admins->map(function (Admin $admin) use ($user) {
            if ($admin->hasPermissionTo("users")) {
                $admin->notify(new NewUserRegisteredNotification($user));
            }
        });

    }

}
