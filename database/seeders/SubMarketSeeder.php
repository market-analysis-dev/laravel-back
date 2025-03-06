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
            // * Guanajuato
            ['id' => 1, 'name' => 'Celaya', 'status' => 'active', 'market_id' => 1],
            ['id' => 2, 'name' => 'Leon', 'status' => 'active', 'market_id' => 1],
            ['id' => 3, 'name' => 'Silao', 'status' => 'active', 'market_id' => 1],
            ['id' => 4, 'name' => 'Irapuato', 'status' => 'active', 'market_id' => 1],
            ['id' => 5, 'name' => 'Lagos de Moreno', 'status' => 'active', 'market_id' => 1],
            ['id' => 6, 'name' => 'Salamanca', 'status' => 'active', 'market_id' => 1],
            // * Queretaro
            ['id' => 7, 'name' => 'Airport', 'status' => 'active', 'market_id' => 2],
            ['id' => 8, 'name' => 'El Marques', 'status' => 'active', 'market_id' => 2],
            ['id' => 9, 'name' => 'North', 'status' => 'active', 'market_id' => 2],
            ['id' => 10, 'name' => 'Last Mile', 'status' => 'active', 'market_id' => 2],
            // Mexico City
            ['id' => 11, 'name' => 'Cuautitlan', 'status' => 'active', 'market_id' => 3],
            ['id' => 12, 'name' => 'Huehuetoca', 'status' => 'active', 'market_id' => 3],
            ['id' => 13, 'name' => 'Tepotzotlan', 'status' => 'active', 'market_id' => 3],
            ['id' => 14, 'name' => 'Tultitlan', 'status' => 'active', 'market_id' => 3],
            ['id' => 15, 'name' => 'Tlalnepantla', 'status' => 'active', 'market_id' => 3],
            ['id' => 16, 'name' => 'Naucalpan', 'status' => 'active', 'market_id' => 3],
            ['id' => 17, 'name' => 'Azcapotzalco - Vallejo', 'status' => 'active', 'market_id' => 3],
            ['id' => 18, 'name' => 'Iztapalapa', 'status' => 'active', 'market_id' => 3],
            ['id' => 19, 'name' => 'Atizapan', 'status' => 'active', 'market_id' => 3],
            ['id' => 20, 'name' => 'Coacalco', 'status' => 'active', 'market_id' => 3],
            ['id' => 21, 'name' => 'Last Mile', 'status' => 'active', 'market_id' => 3],
            ['id' => 22, 'name' => 'Tultepec', 'status' => 'active', 'market_id' => 3],
            ['id' => 23, 'name' => 'Toluca', 'status' => 'active', 'market_id' => 3],
            // * Matamoros
            ['id' => 24, 'name' => 'West', 'status' => 'active', 'market_id' => 4],
            ['id' => 25, 'name' => 'East', 'status' => 'active', 'market_id' => 4],
            // * Monterrey
            ['id' => 26, 'name' => 'Apodaca', 'status' => 'active', 'market_id' => 5],
            ['id' => 27, 'name' => 'Cienega de Flores', 'status' => 'active', 'market_id' => 5],
            ['id' => 28, 'name' => 'Escobedo', 'status' => 'active', 'market_id' => 5],
            ['id' => 29, 'name' => 'Santa Catarina', 'status' => 'active', 'market_id' => 5],
            ['id' => 30, 'name' => 'Guadalupe', 'status' => 'active', 'market_id' => 5],
            ['id' => 31, 'name' => 'Pesqueria', 'status' => 'active', 'market_id' => 5],
            ['id' => 32, 'name' => 'Last Mile', 'status' => 'active', 'market_id' => 5],
            // * Chihuahua
            ['id' => 33, 'name' => 'East', 'status' => 'active', 'market_id' => 6],
            ['id' => 34, 'name' => 'West', 'status' => 'active', 'market_id' => 6],
            // * Puebla
            ['id' => 35, 'name' => 'Cuautlancingo', 'status' => 'active', 'market_id' => 7],
            ['id' => 36, 'name' => 'San Jose Chiapa', 'status' => 'active', 'market_id' => 7],
            ['id' => 37, 'name' => 'Huejotzingo', 'status' => 'active', 'market_id' => 7],
            ['id' => 38, 'name' => 'Tlaxcala', 'status' => 'active', 'market_id' => 7],
            // * Saltillo
            ['id' => 39, 'name' => 'Ramos Arizpe', 'status' => 'active', 'market_id' => 8],
            ['id' => 40, 'name' => 'Arteaga', 'status' => 'active', 'market_id' => 8],
            ['id' => 41, 'name' => 'Derramadero', 'status' => 'active', 'market_id' => 8],
            ['id' => 42, 'name' => 'Saltillo', 'status' => 'active', 'market_id' => 8],
            // * San Luis Potosi
            ['id' => 43, 'name' => 'Tres Naciones', 'status' => 'active', 'market_id' => 9],
            ['id' => 44, 'name' => 'Milenium', 'status' => 'active', 'market_id' => 9],
            ['id' => 45, 'name' => 'Logistik', 'status' => 'active', 'market_id' => 9],
            ['id' => 46, 'name' => 'WTC', 'status' => 'active', 'market_id' => 9],
            ['id' => 47, 'name' => 'Las Colinas', 'status' => 'active', 'market_id' => 9],
            ['id' => 48, 'name' => 'San Luis de la Paz', 'status' => 'active', 'market_id' => 9],
            // * Guadalajara
            ['id' => 49, 'name' => 'El Salto', 'status' => 'active', 'market_id' => 10],
            ['id' => 50, 'name' => 'South Periferico', 'status' => 'active', 'market_id' => 10],
            ['id' => 51, 'name' => 'Zapopan', 'status' => 'active', 'market_id' => 10],
            ['id' => 52, 'name' => 'Lopez Mateos', 'status' => 'active', 'market_id' => 10],
            // * Juarez
            ['id' => 53, 'name' => 'South', 'status' => 'active', 'market_id' => 11],
            ['id' => 54, 'name' => 'Southeast', 'status' => 'active', 'market_id' => 11],
            ['id' => 55, 'name' => 'North', 'status' => 'active', 'market_id' => 11],
            ['id' => 56, 'name' => 'Central', 'status' => 'active', 'market_id' => 11],
            ['id' => 57, 'name' => 'East', 'status' => 'active', 'market_id' => 11],
            ['id' => 58, 'name' => 'Southwest', 'status' => 'active', 'market_id' => 11],
            // * Mexicali
            ['id' => 59, 'name' => 'North', 'status' => 'active', 'market_id' => 12],
            ['id' => 60, 'name' => 'South', 'status' => 'active', 'market_id' => 12],
            ['id' => 61, 'name' => 'East', 'status' => 'active', 'market_id' => 12],
            ['id' => 62, 'name' => 'Central', 'status' => 'active', 'market_id' => 12],
            // * Tijuana
            ['id' => 63, 'name' => 'Central', 'status' => 'active', 'market_id' => 13],
            ['id' => 64, 'name' => 'Libramiento', 'status' => 'active', 'market_id' => 13],
            ['id' => 65, 'name' => 'Florido', 'status' => 'active', 'market_id' => 13],
            ['id' => 66, 'name' => 'Otay', 'status' => 'active', 'market_id' => 13],
            ['id' => 67, 'name' => 'La Mesa', 'status' => 'active', 'market_id' => 13],
            ['id' => 68, 'name' => 'Rosarito', 'status' => 'active', 'market_id' => 13],
            ['id' => 69, 'name' => 'El Aguila', 'status' => 'active', 'market_id' => 13],
            ['id' => 70, 'name' => 'Tecate', 'status' => 'active', 'market_id' => 13],
            ['id' => 71, 'name' => 'Insurgentes', 'status' => 'active', 'market_id' => 13],
            // * Reynosa
            ['id' => 72, 'name' => 'Pharr Bridge', 'status' => 'active', 'market_id' => 14],
            ['id' => 73, 'name' => 'West', 'status' => 'active', 'market_id' => 14],
            ['id' => 74, 'name' => 'Central', 'status' => 'active', 'market_id' => 14],
            ['id' => 75, 'name' => 'Northwest', 'status' => 'active', 'market_id' => 14],
            // * Nuevo Laredo
            ['id' => 76, 'name' => 'East', 'status' => 'active', 'market_id' => 15],
            ['id' => 77, 'name' => 'West', 'status' => 'active', 'market_id' => 15],
            // * Aguascalientes
            ['id' => 78, 'name' => 'East', 'status' => 'active', 'market_id' => 16],
            ['id' => 79, 'name' => 'West', 'status' => 'active', 'market_id' => 16],
            // * Hidalgo
            ['id' => 80, 'name' => 'Pachuca', 'status' => 'active', 'market_id' => 17],
            // * Toluca (no hay)
            // * Hermosillo
            ['id' => 81, 'name' => 'South', 'status' => 'active', 'market_id' => 18],
            ['id' => 82, 'name' => 'East', 'status' => 'active', 'market_id' => 18],
            ['id' => 83, 'name' => 'West', 'status' => 'active', 'market_id' => 18],
            // * La Laguna
            ['id' => 84, 'name' => 'Torreon', 'status' => 'active', 'market_id' => 19],
            ['id' => 85, 'name' => 'Gomez Palacio', 'status' => 'active', 'market_id' => 19],
            ['id' => 86, 'name' => 'Matamoros', 'status' => 'active', 'market_id' => 19],
            // * Merida
            ['id' => 87, 'name' => 'East', 'status' => 'active', 'market_id' => 20],
        ];

        SubMarket::insert($data);

    }
}
