<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\IndustrialPark;
use App\Models\Market;
use App\Models\Region;
use App\Models\SubMarket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/cams-1.csv');
        $file = fopen($path, 'r');

        $header = fgetcsv($file);
        $expectedColumnCount = count($header);

        $data = [];
        $id = 1;

        while (($row = fgetcsv($file)) !== false) {
            $row = array_pad($row, $expectedColumnCount, null);

            $industrial_park = IndustrialPark::where('name', $row[1])->first();
            $developer = Developer::where('name', $row[2])->first();
            $region = Region::where('name', $row[3])->first();
            $market = Market::where('name', $row[4])->first();
            $submarket = SubMarket::where('name', $row[5])->first();


            $currency = isset($row[6]) ? strtoupper(trim($row[6])) : null;
            if (!in_array($currency, ['USD', 'MXP'])) {
                $currency = 'USD';
            }

                $data[] = [
                    'id' => $id++,
                    'industrial_park_id' => $industrial_park->id ?? null,
                    'developer_id' => $developer->id ?? null,
                    'region_id' => $region->id ?? null,
                    'market_id' => $market->id ?? null,
                    'sub_market_id' => $submarket->id ?? null,
                    'cam_building_sf' => $row[7] ?? null,
                    'cam_land_sf' => $row[8] ?? null,
                    'has_cam_services' => $row[9] ?? null,
                    'has_lightning_maintenance' => $row[10] ?? null,
                    'has_park_administration' => $row[11] ?? null,
                    'storm_sewer_maintenance' => $row[12] ?? null,
                    'has_surveillance' => $row[13] ?? null,
                    'has_management_fee' => $row[14] ?? null,
                    'currency' => $currency ?? null,
                    'latitude' => $row[15] ?? null,
                    'longitude' => $row[16] ?? null,
                ];
        }

        fclose($file);

        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('cams')->insert($chunk);
        }
    }


}
