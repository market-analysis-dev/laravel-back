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
            ['name' => 'buildings.approve'],
            ['name' => 'buildings.draft'],
            ['name' => 'buildings.listClasses'],
            ['name' => 'buildings.listLoadingDoors'],
            ['name' => 'buildings.listPhases'],
            ['name' => 'buildings.listTenancies'],
            ['name' => 'buildings.listLightnings'],
            ['name' => 'buildings.listTypeGenerations'],
            ['name' => 'buildings.listTypeConstructions'],
            ['name' => 'buildings.listFireProtectionSystems'],
            ['name' => 'buildings.listTechnicalImprovements'],
            ['name' => 'buildings.listBuildingsCompanyTypes'],
            ['name' => 'buildings.listFinalUses'],
            ['name' => 'buildings.listBuildingsStatus'],
            ['name' => 'buildings.listDeals'],
            ['name' => 'buildings.uploadFiles'],
            ['name' => 'buildings.layoutDesign'],


            ['name' => 'buildings.availability.index'],
            ['name' => 'buildings.availability.show'],
            ['name' => 'buildings.availability.create'],
            ['name' => 'buildings.availability.update'],
            ['name' => 'buildings.availability.destroy'],
            ['name' => 'buildings.availability.to-absorption'],

            ['name' => 'buildings.absorption.index'],
            ['name' => 'buildings.absorption.show'],
            ['name' => 'buildings.absorption.create'],
            ['name' => 'buildings.absorption.update'],
            ['name' => 'buildings.absorption.destroy'],
            ['name' => 'buildings.absorption.to-available'],

            ['name' => 'buildings.contacts.index'],
            ['name' => 'buildings.contacts.show'],
            ['name' => 'buildings.contacts.create'],
            ['name' => 'buildings.contacts.update'],
            ['name' => 'buildings.contacts.destroy'],

            ['name' => 'industrial-parks.index'],
            ['name' => 'industrial-parks.show'],
            ['name' => 'industrial-parks.create'],
            ['name' => 'industrial-parks.update'],
            ['name' => 'industrial-parks.destroy'],

            ['name' => 'regions.index'],

            ['name' => 'currencies.index'],

            ['name' => 'markets.index'],

            ['name' => 'submarkets.index'],

            ['name' => 'permissions.index'],

            ['name' => 'tenants.index'],
            ['name' => 'tenants.show'],
            ['name' => 'tenants.create'],
            ['name' => 'tenants.update'],
            ['name' => 'tenants.destroy'],

            ['name' => 'developers.index'],
            ['name' => 'developers.show'],
            ['name' => 'developers.create'],
            ['name' => 'developers.update'],
            ['name' => 'developers.destroy'],

            ['name' => 'shelters.index'],

            ['name' => 'brokers.index'],
            ['name' => 'brokers.show'],
            ['name' => 'brokers.create'],
            ['name' => 'brokers.update'],
            ['name' => 'brokers.destroy'],

            ['name' => 'industries.index'],
            ['name' => 'industries.show'],
            ['name' => 'industries.create'],
            ['name' => 'industries.update'],
            ['name' => 'industries.destroy'],

            ['name' => 'companies.index'],
            ['name' => 'companies.show'],
            ['name' => 'companies.create'],
            ['name' => 'companies.update'],
            ['name' => 'companies.destroy'],

            ['name' => 'countries.index'],

            ['name' => 'companies.contact.index'],
            ['name' => 'companies.contact.show'],
            ['name' => 'companies.contact.create'],
            ['name' => 'companies.contact.update'],
            ['name' => 'companies.contact.destroy'],

            ['name' => 'lands.absorption.index'],
            ['name' => 'lands.absorption.show'],
            ['name' => 'lands.absorption.create'],
            ['name' => 'lands.absorption.update'],
            ['name' => 'lands.absorption.destroy'],

            ['name' => 'lands.available.index'],
            ['name' => 'lands.available.show'],
            ['name' => 'lands.available.create'],
            ['name' => 'lands.available.update'],
            ['name' => 'lands.available.destroy'],

            ['name' => 'lands.contacts.index'],
            ['name' => 'lands.contacts.show'],
            ['name' => 'lands.contacts.create'],
            ['name' => 'lands.contacts.update'],
            ['name' => 'lands.contacts.destroy'],
            ['name' => 'lands.contacts.addContact'],

            ['name' => 'lands.index'],
            ['name' => 'lands.show'],
            ['name' => 'lands.create'],
            ['name' => 'lands.update'],
            ['name' => 'lands.destroy'],
            ['name' => 'lands.listParcelShape'],
            ['name' => 'lands.listZoning'],
            ['name' => 'lands.getLandTypeBuyer'],
            ['name' => 'lands.getServiceState'],

            ['name' => 'reit-types.index'],
            ['name' => 'reit-types.show'],
            ['name' => 'reit-types.create'],
            ['name' => 'reit-types.update'],
            ['name' => 'reit-types.destroy'],

            ['name' => 'reits.index'],
            ['name' => 'reits.show'],
            ['name' => 'reits.create'],
            ['name' => 'reits.update'],
            ['name' => 'reits.destroy'],

            ['name' => 'modules.index'],

            ['name' => 'reit-annual.index'],
            ['name' => 'reit-annual.show'],
            ['name' => 'reit-annual.create'],
            ['name' => 'reit-annual.update'],
            ['name' => 'reit-annual.destroy'],

            ['name' => 'reit-mortgage.index'],
            ['name' => 'reit-mortgage.show'],
            ['name' => 'reit-mortgage.create'],
            ['name' => 'reit-mortgage.update'],
            ['name' => 'reit-mortgage.destroy'],

            ['name' => 'cams.index'],
            ['name' => 'cams.show'],
            ['name' => 'cams.create'],
            ['name' => 'cams.update'],
            ['name' => 'cams.destroy'],

            ['name' => 'market-growths.index'],
            ['name' => 'market-growths.show'],
            ['name' => 'market-growths.create'],
            ['name' => 'market-growths.update'],
            ['name' => 'market-growths.destroy'],
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}

