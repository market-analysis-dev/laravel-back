<?php

namespace Database\Seeders;

use App\Models\Shelter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShelterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'American Industries'],
            ['name' => 'Intermex'],
            ['name' => 'NAPS'],
            ['name' => 'None'],
            ['name' => 'Prodensa'],
            ['name' => 'Tacna'],
            ['name' => 'Tecma'],
        ];

        Shelter::insert($data);
    }
}
