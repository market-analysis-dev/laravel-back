<?php

namespace Database\Seeders;

use App\Models\Cam;
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
            BrokerSeeder::class,
            ShelterSeeder::class,
            TenantSeeder::class,
            ContactSeeder::class,
            SubMarketSeeder::class,
            DeveloperSeeder::class,
            IndustrialParkSeeder::class,
            CountrySeeder::class,
            IndustrySeeder::class,
            CompanySeeder::class,
            CompanyContactSeeder::class,
            ReitTypeSeeder::class,
            ReitSeeder::class,
            ModuleSeeder::class,
            CamSeeder::class,
            ConfigurationSeeder::class,
//            UserClientSeeder::class,
        ]);
    }
}
