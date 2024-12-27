<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'name' => 'CPA'],
            ['id' => 2, 'name' => 'Parks'],
            ['id' => 3, 'name' => 'FUNO'],
            ['id' => 4, 'name' => 'Construye Industrial'],
            ['id' => 5, 'name' => 'Fibra Danhos'],
            ['id' => 6, 'name' => 'Zayat'],
        ];

        Owner::insert($data);
    }
}
