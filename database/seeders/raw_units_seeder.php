<?php

namespace Database\Seeders;

use App\Models\raw_units;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class raw_units_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => "Nos", "value" => 1],
            ['name' => "Kg", "value" => 1000],
            ['name' => "Ltr", "value" => 1000],
        ];
        raw_units::insert($data);
    }
}
