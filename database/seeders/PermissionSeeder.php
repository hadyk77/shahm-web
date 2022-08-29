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
                    'ar' => "الطلبات",
                    "en" => "Orders"
                ],
                "name" => "orders"
            ],
            [
                "title" => [
                    'ar' => "الخدمات",
                    "en" => "Services"
                ],
                "name" => "services"
            ],
            [
                "title" => [
                    'ar' => "المستخدمين",
                    "en" => "Users"
                ],
                "name" => "users"
            ],
            [
                "title" => [
                    'ar' => "طلبات الدعم الفني",
                    "en" => "Contact Us"
                ],
                "name" => "contact_us"
            ],
            [
                "title" => [
                    'ar' => "التسويق",
                    "en" => "Marketing"
                ],
                "name" => "marketing"
            ],
            [
                "title" => [
                    'ar' => "الموظفين",
                    "en" => "Staff"
                ],
                "name" => "staff"
            ],
            [
                "title" => [
                    'ar' => "الإعدادات العامة",
                    "en" => "General Setting"
                ],
                "name" => "general_setting"
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
