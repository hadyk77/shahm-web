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
        $admins = Admin::query()->whereHas("roles", function ($query) {
            $query->where('roles.name', "users");
        })->get();

        $admins->map(function (Admin $admin) use ($user) {
            $admin->notify(new NewUserRegisteredNotification($user));
        });

    }

}
