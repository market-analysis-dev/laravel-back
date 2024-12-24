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
            'sub_market_id' => 2,
            'created_by' => 1,
        ]);

        IndustrialPark::create([
            'name' => 'Example Park Two',
            'market_id' => 2,
            'sub_market_id' => null,
            'created_by' => 1,
        ]);
    }
}
