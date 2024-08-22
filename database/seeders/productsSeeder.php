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
            ['name' => "Lemon Malt 250ml", "unitID" => 1, "price" => 1640, 'tp' => 1525.42, 'discount' => 30],
            ['name' => "Peach Malt 250ml", "unitID" => 1, "price" => 1640, 'tp' => 1525.42, 'discount' => 30],
            ['name' => "Mango NR Juice", "unitID" => 1, "price" => 1050, 'tp' => 955.93, 'discount' => 150],
        ];
        products::insert($data);
    }
}
