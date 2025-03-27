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
            ['name' => 'Home'],
            ['name' => 'Market Report'],
            ['name' => 'Analytics'],
            ['name' => 'Bi Charts'],
            ['name' => 'Market Overview'],
            ['name' => 'Fibras'],
            ['name' => 'Parks'],
        ];

        Module::insert($data);
    }
}
