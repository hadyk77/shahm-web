<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(UpgradeAccountOptionsSeeder::class);
        $this->call(GeneralSettingSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(IntroImagesSeeder::class);
        $this->call(VehicleTypeSeeder::class);
    }
}
