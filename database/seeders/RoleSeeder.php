<?php

namespace Database\Seeders;

use App\Enums\GuardEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Laravel\Sanctum\Guard;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role = Role::query()->create([
            "title" => [
                "ar" => "الادمن الرئيسي",
                "en" => "Super admin"
            ],
            "name" => "super_admin",
            "guard_name" => GuardEnum::ADMIN
        ]);

        $permissions = Permission::query()->where("guard_name", GuardEnum::ADMIN)->get();

        $role->syncPermissions($permissions);

    }
}
