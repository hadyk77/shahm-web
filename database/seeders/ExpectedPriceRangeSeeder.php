<?php

namespace Database\Seeders;

use App\Models\ExpectedPriceRange;
use Illuminate\Database\Seeder;

class ExpectedPriceRangeSeeder extends Seeder
{
    public function run()
    {
        ExpectedPriceRange::query()->create([
            "kilometer_from" => 0,
            "kilometer_to" => 2,
            "price_from" => 10,
            "price_to" => 20,
        ]);
        ExpectedPriceRange::query()->create([
            "kilometer_from" => 2,
            "kilometer_to" => 3,
            "price_from" => 21,
            "price_to" => 35,
        ]);
        ExpectedPriceRange::query()->create([
            "kilometer_from" => 3,
            "kilometer_to" => 5,
            "price_from" => 40,
            "price_to" => 100,
        ]);
    }
}
