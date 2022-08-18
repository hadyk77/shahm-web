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
                "title" => "Permissions",
                "name" => "permissions"
            ],
        ];
        foreach ($adminPermissions as $permission) {
            $createdPermission = Permission::query()->create([
                "title" => [
                    "en" => $permission["title"],
                    "ar" => Helper::translate("ar", $permission["title"]),
                ],
                "name" => $permission["name"],
                "guard_name" => GuardEnum::ADMIN
            ]);
            $this->command->info("Permission Created With title " . $createdPermission->title);
        }
    }
}
