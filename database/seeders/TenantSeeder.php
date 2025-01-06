<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/tenants.csv');
        $file = fopen($path, 'r');

        fgetcsv($file);

        $data = [];
        $id = 1;
        while (($row = fgetcsv($file)) !== false) {
            $data[] = [
                'id' => $id++,
                'name' => $row[0],
            ];
        }

        fclose($file);

        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('cat_tenants')->insert($chunk);
        }
    }

}
