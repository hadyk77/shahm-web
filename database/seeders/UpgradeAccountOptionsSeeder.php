<?php

namespace Database\Seeders;

use App\Models\AccountUpgradeOption;
use Illuminate\Database\Seeder;

class UpgradeAccountOptionsSeeder extends Seeder
{
    public function run()
    {
        AccountUpgradeOption::query()->create([
            "title" => [
                'ar' => "شهم مبتدئ"
            ],
            "completed_orders_count" => 100,
        ]);
        AccountUpgradeOption::query()->create([
            "title" => [
                'ar' => "شهم متوسط"
            ],
            "completed_orders_count" => 500,
        ]);
        AccountUpgradeOption::query()->create([
            "title" => [
                'ar' => "شهم محترف"
            ],
            "completed_orders_count" => 1000,
        ]);
    }
}
