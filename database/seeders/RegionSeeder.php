<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['name' => 'BAJIO'],
            ['name' => 'CENTRAL'],
            ['name' => 'NORTHCENTRAL'],
            ['name' => 'NORTHEAST'],
            ['name' => 'NORTHWEST'],
            ['name' => 'SOUTH'],
        ];

        Region::insert($regions);
    }
}
