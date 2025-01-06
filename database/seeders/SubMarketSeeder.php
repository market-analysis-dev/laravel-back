<?php

namespace Database\Seeders;

use App\Models\SubMarket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubMarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'name' => 'Celaya', 'status' => 'active', 'market_id' => 1],
            ['id' => 2, 'name' => 'Irapuato', 'status' => 'active', 'market_id' => 1],
            ['id' => 3, 'name' => 'Lagos de Moreno', 'status' => 'active', 'market_id' => 1],
            ['id' => 4, 'name' => 'Leon', 'status' => 'active', 'market_id' => 1],
            ['id' => 5, 'name' => 'Salamanca', 'status' => 'active', 'market_id' => 1],
            ['id' => 6, 'name' => 'Silao', 'status' => 'active', 'market_id' => 1],
            ['id' => 7, 'name' => 'Airport', 'status' => 'active', 'market_id' => 2],
            ['id' => 8, 'name' => 'El Marques', 'status' => 'active', 'market_id' => 2],
            ['id' => 9, 'name' => 'North', 'status' => 'active', 'market_id' => 2],
            ['id' => 10, 'name' => 'Atizapan', 'status' => 'active', 'market_id' => 3],
            ['id' => 11, 'name' => 'Azcapotzalco - Vallejo', 'status' => 'active', 'market_id' => 3],
            ['id' => 12, 'name' => 'Coacalco', 'status' => 'active', 'market_id' => 3],
            ['id' => 13, 'name' => 'Cuautitlan', 'status' => 'active', 'market_id' => 3],
            ['id' => 14, 'name' => 'Huehuetoca', 'status' => 'active', 'market_id' => 3],
            ['id' => 15, 'name' => 'Iztapalapa', 'status' => 'active', 'market_id' => 3],
            ['id' => 16, 'name' => 'Last Mile', 'status' => 'active', 'market_id' => 3],
            ['id' => 17, 'name' => 'Naucalpan', 'status' => 'active', 'market_id' => 3],
            ['id' => 18, 'name' => 'Tepotzotlan', 'status' => 'active', 'market_id' => 3],
            ['id' => 19, 'name' => 'Tlalnepantla', 'status' => 'active', 'market_id' => 3],
            ['id' => 20, 'name' => 'Toluca', 'status' => 'active', 'market_id' => 3],
            ['id' => 21, 'name' => 'Tultepec', 'status' => 'active', 'market_id' => 3],
            ['id' => 22, 'name' => 'Tultitlan', 'status' => 'active', 'market_id' => 3],
            ['id' => 23, 'name' => 'East', 'status' => 'active', 'market_id' => 4],
            ['id' => 24, 'name' => 'West', 'status' => 'active', 'market_id' => 4],
            ['id' => 25, 'name' => 'Apodaca', 'status' => 'active', 'market_id' => 5],
            ['id' => 26, 'name' => 'Cienega de Flores', 'status' => 'active', 'market_id' => 5],
            ['id' => 27, 'name' => 'Escobedo', 'status' => 'active', 'market_id' => 5],
            ['id' => 28, 'name' => 'Guadalupe', 'status' => 'active', 'market_id' => 5],
            ['id' => 29, 'name' => 'Last Mile', 'status' => 'active', 'market_id' => 5],
            ['id' => 30, 'name' => 'Pesqueria', 'status' => 'active', 'market_id' => 5],
            ['id' => 31, 'name' => 'Santa Catarina', 'status' => 'active', 'market_id' => 5],
            ['id' => 32, 'name' => 'East', 'status' => 'active', 'market_id' => 6],
            ['id' => 33, 'name' => 'West', 'status' => 'active', 'market_id' => 6],
            ['id' => 34, 'name' => 'Cuautlancingo', 'status' => 'active', 'market_id' => 7],
            ['id' => 35, 'name' => 'Huejotzingo', 'status' => 'active', 'market_id' => 7],
            ['id' => 36, 'name' => 'San Jose Chiapa', 'status' => 'active', 'market_id' => 7],
            ['id' => 37, 'name' => 'Tlaxcala', 'status' => 'active', 'market_id' => 7],
            ['id' => 38, 'name' => 'Arteaga', 'status' => 'active', 'market_id' => 8],
            ['id' => 39, 'name' => 'Derramadero', 'status' => 'active', 'market_id' => 8],
            ['id' => 40, 'name' => 'Ramos Arizpe', 'status' => 'active', 'market_id' => 8],
            ['id' => 41, 'name' => 'Saltillo', 'status' => 'active', 'market_id' => 8],
            ['id' => 42, 'name' => 'Las Colinas', 'status' => 'active', 'market_id' => 9],
            ['id' => 43, 'name' => 'Logistik', 'status' => 'active', 'market_id' => 9],
            ['id' => 44, 'name' => 'Milenium', 'status' => 'active', 'market_id' => 9],
            ['id' => 45, 'name' => 'San Luis de la Paz', 'status' => 'active', 'market_id' => 9],
            ['id' => 46, 'name' => 'Tres Naciones', 'status' => 'active', 'market_id' => 9],
            ['id' => 47, 'name' => 'WTC', 'status' => 'active', 'market_id' => 9],
            ['id' => 48, 'name' => 'El Salto', 'status' => 'active', 'market_id' => 10],
            ['id' => 49, 'name' => 'Lopez Mateos', 'status' => 'active', 'market_id' => 10],
            ['id' => 50, 'name' => 'South Periferico', 'status' => 'active', 'market_id' => 10],
            ['id' => 51, 'name' => 'Zapopan', 'status' => 'active', 'market_id' => 10],
            ['id' => 52, 'name' => 'Central', 'status' => 'active', 'market_id' => 11],
            ['id' => 53, 'name' => 'East', 'status' => 'active', 'market_id' => 11],
            ['id' => 54, 'name' => 'North', 'status' => 'active', 'market_id' => 11],
            ['id' => 55, 'name' => 'South', 'status' => 'active', 'market_id' => 11],
            ['id' => 56, 'name' => 'Southeast', 'status' => 'active', 'market_id' => 11],
            ['id' => 57, 'name' => 'Southwest', 'status' => 'active', 'market_id' => 11],
            ['id' => 58, 'name' => 'Central', 'status' => 'active', 'market_id' => 12],
            ['id' => 59, 'name' => 'East', 'status' => 'active', 'market_id' => 12],
            ['id' => 60, 'name' => 'North', 'status' => 'active', 'market_id' => 12],
            ['id' => 61, 'name' => 'South', 'status' => 'active', 'market_id' => 12],
            ['id' => 62, 'name' => 'Central', 'status' => 'active', 'market_id' => 13],
            ['id' => 63, 'name' => 'El Aguila', 'status' => 'active', 'market_id' => 13],
            ['id' => 64, 'name' => 'Florido', 'status' => 'active', 'market_id' => 13],
            ['id' => 65, 'name' => 'Insurgentes', 'status' => 'active', 'market_id' => 13],
            ['id' => 66, 'name' => 'La Mesa', 'status' => 'active', 'market_id' => 13],
            ['id' => 67, 'name' => 'Libramiento', 'status' => 'active', 'market_id' => 13],
            ['id' => 68, 'name' => 'Otay', 'status' => 'active', 'market_id' => 13],
            ['id' => 69, 'name' => 'Rosarito', 'status' => 'active', 'market_id' => 13],
            ['id' => 70, 'name' => 'Tecate', 'status' => 'active', 'market_id' => 13],
            ['id' => 71, 'name' => 'Central', 'status' => 'active', 'market_id' => 14],
            ['id' => 72, 'name' => 'Northwest', 'status' => 'active', 'market_id' => 14],
            ['id' => 73, 'name' => 'Pharr Bridge', 'status' => 'active', 'market_id' => 14],
            ['id' => 74, 'name' => 'West', 'status' => 'active', 'market_id' => 14],
            ['id' => 75, 'name' => 'East', 'status' => 'active', 'market_id' => 15],
            ['id' => 76, 'name' => 'West', 'status' => 'active', 'market_id' => 15],
            ['id' => 77, 'name' => 'East', 'status' => 'active', 'market_id' => 16],
            ['id' => 78, 'name' => 'West', 'status' => 'active', 'market_id' => 16],
            ['id' => 79, 'name' => 'Pachuca', 'status' => 'active', 'market_id' => 17],
            ['id' => 80, 'name' => 'Gomez Palacio', 'status' => 'active', 'market_id' => 18],
            ['id' => 81, 'name' => 'Matamoros', 'status' => 'active', 'market_id' => 18],
            ['id' => 82, 'name' => 'Torreon', 'status' => 'active', 'market_id' => 18],
            ['id' => 83, 'name' => 'East', 'status' => 'active', 'market_id' => 19],
            ['id' => 84, 'name' => 'South', 'status' => 'active', 'market_id' => 19],
            ['id' => 85, 'name' => 'West', 'status' => 'active', 'market_id' => 19],
            ['id' => 86, 'name' => 'East', 'status' => 'active', 'market_id' => 20],
        ];

        SubMarket::insert($data);

    }
}
