<?php

namespace Database\Seeders;

use App\Models\IndustrialPark;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndustrialParkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IndustrialPark::create([
            'name' => 'Example Park',
            'market_id' => 1,
            'submarket_id' => 2,
            'created_by' => 1,
        ]);

        IndustrialPark::create([
            'name' => 'Example Park Two',
            'market_id' => 2,
            'submarket_id' => 2,
            'created_by' => 1,
        ]);
    }
}
