<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'id' => '08216ec5-295e-4349-ac61-72849b331ba8',
                'price' => 23,
                'quantity' => 4,
                'crop_id' => '75954b99-50d5-40af-8059-11c81a8b6491',
                'user_id' => 1,
                'created_at' => '2023-12-09 00:49:15',
                'updated_at' => '2023-12-11 00:49:15',
            ],
            [
                'id' => '08b91d0c-f3fd-442f-a4f0-e82d8082ecbb',
                'price' => 12,
                'quantity' => 21,
                'crop_id' => '674017ed-fe7a-4027-b33c-99bdae146a23',
                'user_id' => 1,
                'created_at' => '2023-12-10 14:24:31',
                'updated_at' => '2023-12-10 14:24:31',
            ],
            // Add more products as needed
        ]);
    }
}
