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
            [
                'name' => 'DANHOS',
                'reit_type_id' => 2,
                ],
            [
                'name' => 'FUNO',
                'reit_type_id' => 2,
                ],
            [
                'name' => 'HOTEL',
                'reit_type_id' => 3,
                ],
            [
                'name' => 'INN',
                'reit_type_id' => 3,
            ],
            [
                'name' => 'MACQUARIE',
                'reit_type_id' => 2,
                ],
            [
                'name' => 'MONTERREY',
                'reit_type_id' => 2,
            ],
            [
                'name' => 'NOVA',
                'reit_type_id' => 2,
            ],
            [
                'name' => 'PLUS',
                'reit_type_id' => 2,
                ],
            [
                'name' => 'PROLOGIS',
                'reit_type_id' => 1,
            ],
            [
                'name' => 'SHOP',
                'reit_type_id' => 4,
                ],
            [
                'name' => 'STORAGE',
                'reit_type_id' => 5,
                ],
            [
                'name' => 'TELESITES',
                'reit_type_id' => 4,
                ],
            [
                'name' => 'TERRAFINA',
                'reit_type_id' => 1,
                ],
            [
                'name' => 'UPSITE',
                'reit_type_id' => 1,
                ],
        ];

        Reit::insert($data);
    }
}
