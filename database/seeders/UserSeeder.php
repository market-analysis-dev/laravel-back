<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'middle_name' => 'User',
                'last_name' => 'Dev',
                'user_name' => 'admin.dev',
                'password' => Hash::make('password'),
                'company_id' => 1,
                'user_type_id' => 1,
                'total_screens' => 1,
                'status' => 'Activo'
            ],
        ]);

        $user = User::where('user_name', 'admin.dev')->first();
        $user->assignRole(Roles::ADMIN);
    }
}
