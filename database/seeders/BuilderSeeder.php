<?php

namespace Database\Seeders;

use App\Models\Builder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuilderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/builders.csv');
        $file = fopen($path, 'r');

        fgetcsv($file);

        $data = [];
        $id = 1;
        while (($row = fgetcsv($file)) !== false) {
            $data[] = [
                'id' => $id++,
                'name' => $row[1],
            ];
        }

        fclose($file);

        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('cat_builders')->insert($chunk);
        }
    }
}
