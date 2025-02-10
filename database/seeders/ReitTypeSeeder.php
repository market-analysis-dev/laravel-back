<?php

namespace Database\Seeders;

use App\Models\ReitType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Industrial'],
            ['name' => 'Diversified'],
            ['name' => 'Hotel'],
            ['name' => 'Retail'],
            ['name' => 'Self-storage'],
        ];

        ReitType::insert($data);
    }
}
