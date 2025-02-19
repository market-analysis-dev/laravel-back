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

            if (count($row) !== $expectedColumnCount) {
                continue;
            }

            $industrial_park = IndustrialPark::where('name', $row[1])->first();
            $developer = Developer::where('name', $row[2])->first();
            $region = Region::where('name', $row[3])->first();
            $market = Market::where('name', $row[4])->first();
            $submarket = SubMarket::where('name', $row[5])->first();


            $currency = isset($row[6]) ? strtoupper(trim($row[6])) : null;
            if (!in_array($currency, ['USD', 'MXP'])) {
                $currency = 'USD';
            }

            if ($industrial_park && $developer && $region && $market && $submarket && $currency) {
                $data[] = [
                    'id' => $id++,
                    'industrial_park_id' => $industrial_park->id ?? null,
                    'developer_id' => $developer->id ?? null,
                    'region_id' => $region->id ?? null,
                    'market_id' => $market->id ?? null,
                    'submarket_id' => $submarket->id ?? null,
                    'cam_building_sf' => $row[7],
                    'cam_land_sf' => $row[8],
                    'has_cam_services' => $row[9],
                    'has_lightning_maintenance' => $row[10],
                    'has_park_administration' => $row[11],
                    'storm_sewer_maintenance' => $row[12],
                    'has_survelliance' => $row[13],
                    'has_management_fee' => $row[14],
                    'currency' => $currency,
                    'latitude' => $row[15],
                    'longitude' => $row[16],
                ];
            }
        }

        fclose($file);

        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('cams')->insert($chunk);
        }
    }


}
