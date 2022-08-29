<?php

namespace Database\Seeders;

use App\Models\ContactType;
use Illuminate\Database\Seeder;

class ContactTypeSeeder extends Seeder
{
    public function run()
    {
        ContactType::query()->create([
            "title" => [
                'ar' => "شكوى",
                "en" => "Complaint"
            ]
        ]);
        ContactType::query()->create([
            "title" => [
                'ar' => "اقتراح",
                "en" => "Suggestion"
            ]
        ]);
    }

}
