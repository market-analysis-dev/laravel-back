<?php
namespace Database\Seeders;

use App\Models\Permissions;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            ['name' => 'users.index'],
            ['name' => 'users.create'],
            ['name' => 'users.update'],
            ['name' => 'users.destroy'],

            ['name' => 'roles.index'],
            ['name' => 'roles.create'],
            ['name' => 'roles.update'],
            ['name' => 'roles.destroy'],

            ['name' => 'buildings.index'],
            ['name' => 'buildings.create'],
            ['name' => 'buildings.update'],
            ['name' => 'buildings.destroy'],
        ];
        Permissions::create($permissions);
    }
}

