<?php

namespace Database\Seeders;

use App\Models\Fiber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiberSeeder extends Seeder
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

        Fiber::insert($data);
    }
}
