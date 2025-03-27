<?php

namespace Database\Seeders;

use App\Models\SubModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // HOME
            ['name' => 'Availability Buildings', 'module_id' => 1, 'status' => 'active'],
            ['name' => 'Absorption Buildings', 'module_id' => 1, 'status' => 'active'],
            ['name' => 'Available Land', 'module_id' => 1, 'status' => 'active'],
            ['name' => 'Absorption Land', 'module_id' => 1, 'status' => 'active'],
            ['name' => 'CAM', 'module_id' => 1, 'status' => 'active'],
            ['name' => 'Negative Absorption', 'module_id' => 1, 'status' => 'active'],
            ['name' => 'Maret Growth', 'module_id' => 1, 'status' => 'active'],
            // Analytics
            ['name' => 'Absorption', 'module_id' => 3, 'status' => 'active'],
            ['name' => 'Availability', 'module_id' => 3, 'status' => 'active'],
            // Bi Charts
            ['name' => 'Availability', 'module_id' => 4, 'status' => 'active'],
            ['name' => 'GROSS ABSORPTION VS AVAILABILITY', 'module_id' => 4, 'status' => 'active'],
            ['name' => 'GROSS ABSORPTION VS AVAILABILITY', 'module_id' => 4, 'status' => 'active'],
            ['name' => 'Historical Gross Absorption  VS PREVIOUS YEARS', 'module_id' => 4, 'status' => 'active'],
            ['name' => 'Historical Gross Absorption', 'module_id' => 4, 'status' => 'active'],
            ['name' => 'GROSS ABSORPTION BY INDUSTRY/COUNTRY', 'module_id' => 4, 'status' => 'active'],
            ['name' => 'Gross Absorption By Inventory/Bts/Expansion', 'module_id' => 4, 'status' => 'active'],
            ['name' => 'RANKING BY AVAILABILITY', 'module_id' => 4, 'status' => 'active'],
            ['name' => 'Ranking Gross Absorption', 'module_id' => 4, 'status' => 'active'],
        ];

        SubModule::insert($data);
    }
}
