<?php

namespace Database\Seeders;

use App\Enums\GuardEnum;
use App\Helper\Helper;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    public function run()
    {
        $adminPermissions = [
            [
                "title" => [
                    'ar'  => "الصلاحيات",
                    "en" => "Permission"
                ],
                "name" => "permissions"
            ],
            [
                "title" => [
                    'ar'  => "المستخدمين",
                    "en" => "Users"
                ],
                "name" => "users"
            ],
        ];
        foreach ($adminPermissions as $permission) {
            $createdPermission = Permission::query()->create([
                "title" => [
                    "en" => $permission["title"]['en'],
                    "ar" => $permission["title"]['ar'],
                ],
                "name" => $permission["name"],
                "guard_name" => GuardEnum::ADMIN
            ]);
            $this->command->info("Permission Created With title " . $createdPermission->title);
        }
    }
}
