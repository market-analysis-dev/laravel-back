<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/industries.csv');
        $file = fopen($path, 'r');

        fgetcsv($file);

        $data = [];
        while (($row = fgetcsv($file)) !== false) {
            $data[] = [
                'name' => $row[1],
            ];
        }

        fclose($file);

        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('cat_industries')->insert($chunk);
        }

    }
}
