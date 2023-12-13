<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CropsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Crop::insert([
            [
                'crop_id' => '45d2b463-7060-4c21-969d-6b7bb201c5e4',
                'name' => 'Banana (Saba)',
                'average_price' => 0,
                'sales_change' => 0,
                'created_at' => '2023-12-10 13:26:59',
                'updated_at' => '2023-12-10 13:26:59',
            ],
            [
                'crop_id' => '674017ed-fe7a-4027-b33c-99bdae146a23',
                'name' => 'Mustard',
                'average_price' => 0,
                'sales_change' => 0,
                'created_at' => '2023-12-10 13:26:40',
                'updated_at' => '2023-12-10 13:26:40',
            ],
            [
                'crop_id' => '75954b99-50d5-40af-8059-11c81a8b6491',
                'name' => 'Garlic',
                'average_price' => 0,
                'sales_change' => 0,
                'created_at' => '2023-12-10 13:26:23',
                'updated_at' => '2023-12-10 13:26:23',
            ],
            // Add more crops as needed
        ]);
    }
}
