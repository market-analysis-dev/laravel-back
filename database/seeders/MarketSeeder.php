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
            ['id' => 1, 'name' => 'Guanajuato', 'status' => 'active', 'region_id' => 1],
            ['id' => 2, 'name' => 'Queretaro', 'status' => 'active', 'region_id' => 1],
            ['id' => 3, 'name' => 'Mexico City', 'status' => 'active', 'region_id' => 2],
            ['id' => 4, 'name' => 'Matamoros', 'status' => 'active', 'region_id' => 4],
            ['id' => 5, 'name' => 'Monterrey', 'status' => 'active', 'region_id' => 4],
            ['id' => 6, 'name' => 'Chihuahua', 'status' => 'active', 'region_id' => 3],
            ['id' => 7, 'name' => 'Puebla', 'status' => 'active', 'region_id' => 2],
            ['id' => 8, 'name' => 'Saltillo', 'status' => 'active', 'region_id' => 4],
            ['id' => 9, 'name' => 'San Luis Potosi', 'status' => 'active', 'region_id' => 1],
            ['id' => 10, 'name' => 'Guadalajara', 'status' => 'active', 'region_id' => 1],
            ['id' => 11, 'name' => 'Juarez', 'status' => 'active', 'region_id' => 3],
            ['id' => 12, 'name' => 'Mexicali', 'status' => 'active', 'region_id' => 5],
            ['id' => 13, 'name' => 'Tijuana', 'status' => 'active', 'region_id' => 5],
            ['id' => 14, 'name' => 'Reynosa', 'status' => 'active', 'region_id' => 4],
            ['id' => 15, 'name' => 'Nuevo Laredo', 'status' => 'active', 'region_id' => 4],
            ['id' => 16, 'name' => 'Aguascalientes', 'status' => 'active', 'region_id' => 1],
            ['id' => 17, 'name' => 'Hidalgo', 'status' => 'active', 'region_id' => 2],
            ['id' => 18, 'name' => 'Toluca', 'status' => 'active', 'region_id' => 2],
            ['id' => 19, 'name' => 'La Laguna', 'status' => 'active', 'region_id' => 4],
            ['id' => 20, 'name' => 'Hermosillo', 'status' => 'active', 'region_id' => 5],
            ['id' => 21, 'name' => 'Merida', 'status' => 'active', 'region_id' => 6],
        ];

            Market::insert($data);

    }
}
