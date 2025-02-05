<?php

namespace Database\Seeders;

use App\Models\Reit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'DANHOS'],
            ['name' => 'FUNO'],
            ['name' => 'HOTEL'],
            ['name' => 'INN'],
            ['name' => 'MACQUARIE'],
            ['name' => 'MONTERREY'],
            ['name' => 'NOVA'],
            ['name' => 'PLUS'],
            ['name' => 'PROLOGIS'],
            ['name' => 'SHOP'],
            ['name' => 'STORAGE'],
            ['name' => 'TELESITES'],
            ['name' => 'TERRAFINA'],
            ['name' => 'UPSITE'],
        ];

        Reit::insert($data);
    }
}
