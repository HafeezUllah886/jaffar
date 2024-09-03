<?php

namespace Database\Seeders;

use App\Models\salesman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class salesmanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mans = [
            ['name' => 'Test Salesman I'],
            ['name' => 'Test Salesman II'],
        ];

        salesman::insert($mans);
    }
}
