<?php
namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            ['name' => 'users.index'],
            ['name' => 'users.show'],
            ['name' => 'users.create'],
            ['name' => 'users.update'],
            ['name' => 'users.destroy'],

            ['name' => 'roles.index'],
            ['name' => 'roles.show'],
            ['name' => 'roles.create'],
            ['name' => 'roles.update'],
            ['name' => 'roles.destroy'],

            ['name' => 'buildings.index'],
            ['name' => 'buildings.show'],
            ['name' => 'buildings.create'],
            ['name' => 'buildings.update'],
            ['name' => 'buildings.destroy'],
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}

