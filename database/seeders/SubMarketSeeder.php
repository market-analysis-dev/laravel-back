<?php

namespace Database\Seeders;

use App\Models\Market;
use App\Models\SubMarket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/submarkets.csv');
        $file = fopen($path, 'r');

        fgetcsv($file);

        $data = [];
        while (($row = fgetcsv($file)) !== false) {
            $market = Market::where('name', $row[4])->first();
            if($market) {
                $data[] = [
                    'name' => $row[1],
                    'latitude' => $row[2],
                    'longitude' => $row[3],
                    'market_id' => $market->id,
                ];
            }
        }

        fclose($file);

        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('cat_sub_markets')->insert($chunk);
        }

    }
}
