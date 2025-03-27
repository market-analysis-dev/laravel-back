<?php

namespace Database\Seeders;

use App\Models\Broker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/brokers-1.csv');
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
            DB::table('cat_brokers')->insert($chunk);
        }

        $data = [
            [
                'name' => 'None',
            ]
            ];
        Broker::insert($data);
    }
}
