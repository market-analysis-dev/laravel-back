<?php

namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Intermex'],
            ['name' => 'Parks'],
            ['name' => 'MEOR'],
            ['name' => 'Grupo Favier'],
            ['name' => 'MPA Group'],
            ['name' => 'Construye Industrial'],
        ];

        Developer::insert($data);
    }
}
