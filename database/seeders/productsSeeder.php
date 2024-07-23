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
            ['name' => "Lemon Malt 250ml", "unitID" => 1, "price" => 1530, 'tp' => 1423.73, 'discount' => 10],
            ['name' => "Peach Malt 250ml", "unitID" => 2, "price" => 1640, 'tp' => 1525.42, 'discount' => 10],

        ];
        products::insert($data);
    }
}
