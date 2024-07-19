<?php

namespace Database\Seeders;

use App\Models\material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class raw_material_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => "Salt", "unitID" => 1, "price" => 100],
            ['name' => "Oil", "unitID" => 2, "price" => 560],
        ];
        material::insert($data);
    }
}
