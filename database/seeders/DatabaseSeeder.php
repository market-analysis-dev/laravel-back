<?php

namespace Database\Seeders;

use App\Models\IndustrialPark;
use App\Models\Role;
use App\Models\User;
// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            RegionSeeder::class,
            MarketSeeder::class,
            DeveloperSeeder::class,
            SubMarketSeeder::class,
            IndustrialParkSeeder::class,
        ]);
    }
}
