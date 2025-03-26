<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuration::create([
            'file_id' => null,
            'code' => 'SUBMKTKMZ',
            'name' => 'Submarket KMZ',
            'value' => null,
            'description' => null,
            'type' => 'kmz',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Configuration::create([
            'file_id' => null,
            'code' => 'INDPRKKMZ',
            'name' => 'Industrial Parks KMZ',
            'value' => null,
            'description' => null,
            'type' => 'kmz',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
