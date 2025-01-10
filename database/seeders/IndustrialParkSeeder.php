<?php

namespace Database\Seeders;

use App\Models\IndustrialPark;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                // 'id' => $id++,
                'name' => $row[0],
                'market_id' => $row[1],
                'submarket_id' => $row[2]
            ];
        }

        fclose($file);

        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('cat_industrial_parks')->insert($chunk);
        }

        // IndustrialPark::create([
        //     'name' => 'Example Park',
        //     'market_id' => 1,
        //     'submarket_id' => 2,
        //     'created_by' => 1,
        // ]);

        // IndustrialPark::create([
        //     'name' => 'Example Park Two',
        //     'market_id' => 2,
        //     'submarket_id' => 2,
        //     'created_by' => 1,
        // ]);
    }
}
