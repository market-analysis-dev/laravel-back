<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserClientSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/users-clients.csv');

        if (!file_exists($path)) {
            dump("File not exist: $path");
            return;
        }


        $file = fopen($path, 'r');
        if (!$file) {
            dump("Error to open file");
            return;
        }

        $headers = fgetcsv($file);

        $companies = Company::pluck('id', 'name');

        $data = [];
        $count = 0;

        while (($row = fgetcsv($file)) !== false) {
            if (!$row || empty($row[0])) {
                continue;
            }

            $count++;

            $data[] = [
                'name'       => $row[0] ?? null,
                'last_name'  => $row[1] ?? null,
                'company_id' => $companies[$row[2]] ?? null,
                'email'      => $row[3] ?? null,
                'user_name'  => $row[5] ?? null,
                'password'   => Hash::make('password'),
                'status'     => 'Enabled',
            ];

            if ($count % 500 === 0) {
                DB::table('users')->insert($data);
                $data = [];
            }
        }

        fclose($file);

        if (!empty($data)) {
            DB::table('users')->insert($data);
        }
    }

}

