<?php

namespace Database\Seeders;

use App\Enums\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => Roles::MARKETING_EDITOR])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => Roles::FIBRA_EDITOR])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => Roles::FIELD_WORKER])
            ->givePermissionTo(Permission::all());
    
        Role::create(['name' => Roles::WEB_USER])
            ->givePermissionTo(Permission::all());
    }
}
