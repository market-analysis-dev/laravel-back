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
use Illuminate\Support\Facades\Log;


class IndustrialParkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/industrial-parks.csv');
        $file = fopen($path, 'r');

        fgetcsv($file);

        $data = [];
        $id = 1;

        while (($row = fgetcsv($file)) !== false) {
            $data[] = [
                'name' => $row[0],
                'market_id' => $row[1],
                'sub_market_id' => $row[2]
            ];
        }

        fclose($file);

        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('industrial_parks')->insert($chunk);
        }

        /**************/
        /*$path1 = storage_path('app/industrial-parks-v1.csv');
        $file1 = fopen($path1, 'r');

        fgetcsv($file1);

        $data1 = [];
        $id = 1;

        while (($row = fgetcsv($file1)) !== false) {
            $market = Market::where('name', $row[7])->first();
            $submarket = SubMarket::where('name', $row[8])->first();
            $owner = Developer::where('name', $row[5])->first();
            $region = Region::where('name', $row[6])->first();

            if (!$market) {
                Log::warning("For Industrial Park with name: {$row[0]} Market not found: {$row[7]}");
            }

            if (!$submarket) {
                Log::warning("For Industrial Park with name: {$row[0]} Submarket not found: {$row[8]}");
            }

            if($market && $submarket) {
                $record = [
                    'name' => $row[0],
                    'market_id' => $market->id,
                    'sub_market_id' => $submarket->id,
                    'owner_id' => $owner->id ?? null,
                    'region_id' => $region->id ?? null,
                    'total_land_ha' => isset($row[1]) ? (float) str_replace(',', '.', $row[1]) : null,
                    'available_land_ha' => isset($row[2]) ? (float) str_replace(',', '.', $row[2]) : null,
                    'building_number' => $row[4] ?? null,
                    'land_condition' => $row[9] ?? null,
                    'year_built' => $row[10] ?? null,
                    'has_rail_spur' => ($row[11] ?? null) === 'Yes' ? 1 : 0,
                    'has_natural_gas' => ($row[12] ?? null) === 'Yes' ? 1 : 0,
                    'has_sewage' => ($row[13] ?? null) === 'Yes' ? 1 : 0,
                    'has_water' => ($row[14] ?? null) === 'Yes' ? 1 : 0,
                    'has_electric' => ($row[15] ?? null) === 'Yes' ? 1 : 0,
                    'latitude' => $row[17] ?? null,
                    'longitude' => $row[18] ?? null,
                    'comments' => $row[16] ?? null,
                ];
                Log::info("Adding record: " . json_encode($record));
                $data1[] = $record;
            }
        }

        fclose($file1);

        if (!empty($data1)) {
            foreach ($data1 as $record) {
                DB::table('industrial_parks')->updateOrInsert(
                    ['name' => $record['name']],
                    $record
                );
            }
        }*/
        /*********** Second CSV  ***********/
        $path1 = storage_path('app/industrial-parks-v1.csv');
        $file1 = fopen($path1, 'r');
        fgetcsv($file1);

        $groupedData = [];

        while (($row = fgetcsv($file1)) !== false) {
            $market = Market::where('name', $row[7])->first();
            $submarket = SubMarket::where('name', $row[8])->first();
            $owner = Developer::where('name', $row[5])->first();
            $region = Region::where('name', $row[6])->first();

            if (!$market) {
                Log::warning("For Industrial Park with name: {$row[0]} Market not found: {$row[7]}");
            }
            if (!$submarket) {
                Log::warning("For Industrial Park with name: {$row[0]} Submarket not found: {$row[8]}");
            }

            if ($market && $submarket) {
                $name = $row[0];

                $record = [
                    'name' => $name,
                    'market_id' => $market->id,
                    'sub_market_id' => $submarket->id,
                    'owner_id' => $owner->id ?? null,
                    'region_id' => $region->id ?? null,
                    'total_land_ha' => isset($row[1]) ? (float) str_replace(',', '.', $row[1]) : 0,
                    'available_land_ha' => isset($row[2]) ? (float) str_replace(',', '.', $row[2]) : 0,
                    'building_number' => $row[4] ?? 0,
                    'land_condition' => $row[9] ?? null,
                    'year_built' => $row[10] ?? null,
                    'has_rail_spur' => ($row[11] ?? null) === 'Yes' ? 1 : 0,
                    'has_natural_gas' => ($row[12] ?? null) === 'Yes' ? 1 : 0,
                    'has_sewage' => ($row[13] ?? null) === 'Yes' ? 1 : 0,
                    'has_water' => ($row[14] ?? null) === 'Yes' ? 1 : 0,
                    'has_electric' => ($row[15] ?? null) === 'Yes' ? 1 : 0,
                    'latitude' => $row[17] ?? null,
                    'longitude' => $row[18] ?? null,
                    'comments' => $row[16] ?? null,
                ];

                if (isset($groupedData[$name])) {
                    $groupedData[$name]['total_land_ha'] += $record['total_land_ha'];
                    $groupedData[$name]['available_land_ha'] += $record['available_land_ha'];
                    $groupedData[$name]['building_number'] += $record['building_number'];
                } else {
                    $groupedData[$name] = $record;
                }
            }
        }
        fclose($file1);

        if (!empty($groupedData)) {
            foreach ($groupedData as $record) {
                Log::info("Adding record: " . json_encode($record));
                DB::table('industrial_parks')->updateOrInsert(
                    ['name' => $record['name']],
                    $record
                );
            }
        }
    }
}
