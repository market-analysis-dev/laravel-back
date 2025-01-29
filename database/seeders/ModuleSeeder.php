<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Availability'],
            ['name' => 'Absorption'],
            ['name' => 'Bi Charts'],
            ['name' => 'Overview'],
            ['name' => 'Land Available'],
            ['name' => 'Land Absorption'],
            ['name' => 'CAM'],
            ['name' => 'Negative Absorption'],
            ['name' => 'Analytics Availability'],
            ['name' => 'Analytics Absorption'],
            ['name' => 'Market Report'],
            ['name' => 'Market Size'],
            ['name' => 'Industrial Park'],
            ['name' => 'Fibers'],
        ];

        Module::insert($data);
    }
}
