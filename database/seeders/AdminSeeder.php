<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{

    public function run()
    {
        $admin  = Admin::query()->create([
            "name" => "الأدمن الرئيسى",
            "username" => "admin",
            "password" => Hash::make("admin"),
            "email" => "admin@admin.com",
            "email_verified_at" => Carbon::now(),
        ]);

        $admin->assignRole(Role::query()->first());

    }
}
