<?php

namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperSeeder extends Seeder
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
                'is_user_owner' => true,
            ],
            [
                'name' => 'Parks',
                'is_developer' => true,
                'is_owner' => true,
                'is_builder' => true,
                'is_user_owner' => true,
            ],
            [
                'name' => 'MEOR',
                'is_developer' => true,
                'is_owner' => false,
                'is_builder' => false,
                'is_user_owner' => true,
            ],
            [
                'name' => 'Grupo Favier',
                'is_developer' => true,
                'is_owner' => false,
                'is_builder' => true,
                'is_user_owner' => true,
            ],
            [
                'name' => 'MPA Group',
                'is_developer' => true,
                'is_owner' => false,
                'is_builder' => true,
                'is_user_owner' => true,
                ],
            [
                'name' => 'Construye Industrial',
                'is_developer' => true,
                'is_owner' => true,
                'is_builder' => true,
                'is_user_owner' => true,
            ],
            [
                'name' => 'CPA',
                'is_developer' => false,
                'is_owner' => false,
                'is_builder' => false,
                'is_user_owner' => true,
                ],

            [
                'name' => 'FUNO',
                'is_developer' => false,
                'is_owner' => true,
                'is_builder' => false,
                'is_user_owner' => true,
                ],

            [
                'name' => 'Fibra Danhos',
                'is_developer' => false,
                'is_owner' => true,
                'is_builder' => false,
                'is_user_owner' => true,
                ],
            [
                'name' => 'Zayat',
                'is_developer' => false,
                'is_owner' => true,
                'is_builder' => false,
                'is_user_owner' => true,
                ],
        ];

        Developer::insert($data);
        /*Developer::factory()->count(50)->create();*/
    }
}
