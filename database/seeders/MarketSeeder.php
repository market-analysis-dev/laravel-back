<?php

namespace Database\Seeders;

use App\Models\Market;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'name' => 'Guanajuato', 'status' => 'active'],
            ['id' => 2, 'name' => 'Queretaro', 'status' => 'active'],
            ['id' => 3, 'name' => 'Mexico City', 'status' => 'active'],
            ['id' => 4, 'name' => 'Matamoros', 'status' => 'active'],
            ['id' => 5, 'name' => 'Monterrey', 'status' => 'active'],
            ['id' => 6, 'name' => 'Chihuahua', 'status' => 'active'],
            ['id' => 7, 'name' => 'Puebla', 'status' => 'active'],
            ['id' => 8, 'name' => 'Saltillo', 'status' => 'active'],
            ['id' => 9, 'name' => 'San Luis Potosi', 'status' => 'active'],
            ['id' => 10, 'name' => 'Guadalajara', 'status' => 'active'],
            ['id' => 11, 'name' => 'Juarez', 'status' => 'active'],
            ['id' => 12, 'name' => 'Mexicali', 'status' => 'active'],
            ['id' => 13, 'name' => 'Tijuana', 'status' => 'active'],
            ['id' => 14, 'name' => 'Reynosa', 'status' => 'active'],
            ['id' => 15, 'name' => 'Nuevo Laredo', 'status' => 'active'],
            ['id' => 16, 'name' => 'Aguascalientes', 'status' => 'active'],
            ['id' => 17, 'name' => 'Hidalgo', 'status' => 'active'],
            ['id' => 18, 'name' => 'La Laguna', 'status' => 'active'],
            ['id' => 19, 'name' => 'Hermosillo', 'status' => 'active'],
            ['id' => 20, 'name' => 'Merida', 'status' => 'active'],
        ];
        foreach ($data as $item) {
            Market::create($item);
        }
    }
}
