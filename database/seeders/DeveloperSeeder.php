<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Market;
use App\Models\SubMarket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/developers.csv');
        $file = fopen($path, 'r');

        fgetcsv($file);

        $data = [];
        $id = 1;
        while (($row = fgetcsv($file)) !== false) {
            $data[] = [
                'id' => $id++,
                'name' => $row[0],
                'is_developer' => $row[6],
                'is_owner' => $row[7],
                'is_builder' => $row[8],
            ];
        }

        fclose($file);

        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('cat_developers')->insert($chunk);
        }

    }
}
