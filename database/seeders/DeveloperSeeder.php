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
        $path = storage_path('app/builders_new.csv');
        $file = fopen($path, 'r');

        fgetcsv($file);

        $data = [];
        $id = 1;
        while (($row = fgetcsv($file)) !== false) {
            $market_id = null;
            $submarket_id = null;
            $market = Market::where('name', $row[4])->first();
            $submarket = SubMarket::where('name', $row[5])->first();
            if($market) {
                $market_id = $market->id;
            }
            if($submarket) {
                $submarket_id = $submarket->id;
            }
            $data[] = [
                'id' => $id++,
                'name' => $row[0],
                'market_id' => $market_id,
                'submarket_id' => $submarket_id,
                'is_developer' => false,
                'is_owner' => false,
                'is_builder' => true,
            ];
        }

        fclose($file);

        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('cat_developers')->insert($chunk);
        }



        $data = [
            [
                'name' => 'Intermex',
                'is_developer' => true,
                'is_owner' => false,
                'is_builder' => false,
            ],
            [
                'name' => 'Parks',
                'is_developer' => true,
                'is_owner' => true,
                'is_builder' => true,
            ],
            [
                'name' => 'MEOR',
                'is_developer' => true,
                'is_owner' => false,
                'is_builder' => false,
            ],
            [
                'name' => 'CPA',
                'is_developer' => false,
                'is_owner' => false,
                'is_builder' => false,
            ],

            [
                'name' => 'FUNO',
                'is_developer' => false,
                'is_owner' => true,
                'is_builder' => false,
            ],

            [
                'name' => 'Fibra Danhos',
                'is_developer' => false,
                'is_owner' => true,
                'is_builder' => false,
            ],
            [
                'name' => 'Zayat',
                'is_developer' => false,
                'is_owner' => true,
                'is_builder' => false,
            ],
            [
                'name' => 'User Owner',
                'is_developer' => true,
                'is_owner' => true,
                'is_builder' => false,
            ],
        ];

        Developer::insert($data);
        /*Developer::factory()->count(50)->create();*/
    }
}
