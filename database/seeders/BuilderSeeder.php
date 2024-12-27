<?php

namespace Database\Seeders;

use App\Models\Builder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuilderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'name' => 'builder 1'],
            ['id' => 2, 'name' => 'builder 2'],
            ['id' => 3, 'name' => 'builder 3'],
            ['id' => 4, 'name' => 'builder 4'],
            ['id' => 5, 'name' => 'builder 5'],
            ['id' => 6, 'name' => 'builder 6'],
        ];

        Builder::insert($data);
    }
}
