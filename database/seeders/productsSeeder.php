<?php

namespace Database\Seeders;

use App\Models\products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => "Patato Chips Regular", "unitID" => 1, "Price" => 10],
            ['name' => "Patato Chips Spicy", "unitID" => 2, "Price" => 15],

        ];
        products::insert($data);
    }
}
