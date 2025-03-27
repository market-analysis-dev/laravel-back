<?php

namespace App\Http\Controllers;

use App\Models\PermissionsUnique;
use App\Models\PermissionsPolicies;
use App\Models\PermissionsSubModules;
use App\Models\Market;
use App\Models\SubMarket;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;
use App\Models\AccessPolicy;
use App\Http\Resources\AccessPolicyResource;
use App\Http\Requests\StoreAccessPolicyRequest;
use App\Http\Requests\UpdateAccessPolicyRequest;

class AccessPolicyController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ApiResponse
    {
        $policies = AccessPolicy::all();
        return $this->success(data: $policies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        * permissions_unique
        */
        
        $access_policy_id = $request->access_policy_id;
        $excel_permission = $request->excel_permission == true ? 1 : 0;
        $flyer_permission = $request->flyer_permission == true ? 1 : 0;
        $columns_permission = $request->columns_permission == true ? 1 : 0;

        $arrayName = [
            "1" => $excel_permission, // * excel
            "2" => $flyer_permission, // * flyer
            "3" => $columns_permission, // * columnas
        ];

        foreach ($arrayName as $key => $permission) {

            $exists = PermissionsUnique::where('access_policy_id', $access_policy_id)
                    ->where('permission_id', $key)
                    ->exists();

            if (!$exists) {

                PermissionsUnique::insert([
                    'access_policy_id' => $access_policy_id,
                    'permission_id' => $key,
                    'status' => 'active'
                ]);
            }
        }

        $modules_data = json_decode($request->modules_data);
        $sub_modules_data = json_decode($request->sub_modules_data);
        $market_data = json_decode($request->market_data, true);
        $sub_market_data = json_decode($request->sub_market_data, true);
        $years_data = json_decode($request->years_data);
        $quarters_data = json_decode($request->quarters_data);

        /*
         * permissions_policies
         */
        foreach ($modules_data as $key => $module_id) {

            $exists = PermissionPolicies::where('access_policy_id', $access_policy_id)
                    ->where('module_id', $module_id)
                    ->where('status', 'active')
                    ->exists();
                    
            if (!$exists) {
                PermissionPolicies::insert([
                    'access_policy_id' => $access_policy_id,
                    'module_id' => $module_id,
                    'status' => 'active'
                ]);
            }
        }

        /*
         * permissions_submodules
         */
        
        foreach ($sub_modules_data as $key => $sub_modules_id) {
            # code...
            foreach ($market_data as $key => $market_id) {
                
                foreach ($sub_market_data as $key => $sub_market_id) {
                    
                    switch ($sub_modules_id) {
                        case 1:
                        case 3:
                        case 9:
                        case 10:
                        case 17: // * Availability

                            $exists = PermissionSubModules::where('access_policy_id', $access_policy_id)
                                ->where('submodule_id', $sub_modules_id)
                                ->where('market_id', $sub_modules_id)
                                ->where('sub_market_id', $sub_modules_id)
                                ->where('year', $sub_modules_id)
                                ->where('quarter', $sub_modules_id)
                                ->where('status', 'active')
                                ->exists();

                            if (!$exists) {
                                PermissionPolicies::insert([
                                    'access_policy_id' => $access_policy_id,
                                    'submodule_id' => $sub_modules_id,
                                    'market_id' => $market_id,
                                    'sub_market_id' => $sub_market_id,
                                    'year' => NULL,
                                    'quarter' => NULL,
                                    'status' => 'active'
                                ]);
                            }
    
                            break;
    
                        default: // * Absorption
    
                            foreach ($years_data as $key => $year) {
    
                                foreach ($quarters_data as $key => $quarter) {
    
                                    $exists = PermissionsSubModules::where('access_policy_id', $access_policy_id)
                                            ->where('module_id', $module_id)
                                            ->where('market_id', $market_id)
                                            ->where('sub_market_id', $sub_market_id)
                                            ->where('year', $year)
                                            ->where('quarter', $quarter)
                                            ->exists();
    
                                    if (!$exists) {
                                        PermissionsSubModules::insert([
                                            'access_policy_id' => $access_policy_id,
                                            'module_id' => $module_id,
                                            'market_id' => $market_id,
                                            'sub_market_id' => $sub_market_id,
                                            'year' => $year,
                                            'quarter' => $quarter,
                                            'status' => 'active'
                                        ]);
                                    }
                                }
                            }

                        break;
                    }
                }
    
            }
        }

        return response()->json(['message' => 'Permissions added successfully!']);
    }

    public function update(Request $request, $access_policy_id)
    {
        // Primero desactivamos todos los permisos existentes
        PermissionsUnique::where('access_policy_id', $access_policy_id)
            ->update(['status' => 'inactive']);

        PermissionPolicies::where('access_policy_id', $access_policy_id)
            ->update(['status' => 'inactive']);

        PermissionSubModules::where('access_policy_id', $access_policy_id)
            ->update(['status' => 'inactive']);

        // Luego creamos los nuevos permisos (igual que en store)
        $excel_permission = $request->excel_permission == true ? 1 : 0;
        $flyer_permission = $request->flyer_permission == true ? 1 : 0;
        $columns_permission = $request->columns_permission == true ? 1 : 0;

        $arrayName = [
            "1" => $excel_permission, // * excel
            "2" => $flyer_permission, // * flyer
            "3" => $columns_permission, // * columnas
        ];

        foreach ($arrayName as $key => $permission) {
            if ($permission) {
                $exists = PermissionsUnique::where('access_policy_id', $access_policy_id)
                        ->where('permission_id', $key)
                        ->where('status', 'inactive')
                        ->first();

                if ($exists) {
                    $exists->update(['status' => 'active']);
                } else {
                    PermissionsUnique::insert([
                        'access_policy_id' => $access_policy_id,
                        'permission_id' => $key,
                        'status' => 'active'
                    ]);
                }
            }
        }

        $modules_data = json_decode($request->modules_data);
        $sub_modules_data = json_decode($request->sub_modules_data);
        $market_data = json_decode($request->market_data, true);
        $sub_market_data = json_decode($request->sub_market_data, true);
        $years_data = json_decode($request->years_data);
        $quarters_data = json_decode($request->quarters_data);

        // Actualizar módulos
        foreach ($modules_data as $module_id) {
            $exists = PermissionPolicies::where('access_policy_id', $access_policy_id)
                    ->where('module_id', $module_id)
                    ->where('status', 'inactive')
                    ->first();

            if ($exists) {
                $exists->update(['status' => 'active']);
            } else {
                PermissionPolicies::insert([
                    'access_policy_id' => $access_policy_id,
                    'module_id' => $module_id,
                    'status' => 'active'
                ]);
            }
        }

        // Actualizar sub módulos
        foreach ($sub_modules_data as $sub_modules_id) {
            foreach ($market_data as $market_id) {
                foreach ($sub_market_data as $sub_market_id) {
                    switch ($sub_modules_id) {
                        case 1:
                        case 3:
                        case 9:
                        case 10:
                        case 17: // * Availability
                            $exists = PermissionSubModules::where('access_policy_id', $access_policy_id)
                                ->where('submodule_id', $sub_modules_id)
                                ->where('market_id', $market_id)
                                ->where('sub_market_id', $sub_market_id)
                                ->where('status', 'inactive')
                                ->first();

                            if ($exists) {
                                $exists->update(['status' => 'active']);
                            } else {
                                PermissionSubModules::insert([
                                    'access_policy_id' => $access_policy_id,
                                    'submodule_id' => $sub_modules_id,
                                    'market_id' => $market_id,
                                    'sub_market_id' => $sub_market_id,
                                    'year' => NULL,
                                    'quarter' => NULL,
                                    'status' => 'active'
                                ]);
                            }
                            break;

                        default: // * Absorption
                            foreach ($years_data as $year) {
                                foreach ($quarters_data as $quarter) {
                                    $exists = PermissionSubModules::where('access_policy_id', $access_policy_id)
                                        ->where('submodule_id', $sub_modules_id)
                                        ->where('market_id', $market_id)
                                        ->where('sub_market_id', $sub_market_id)
                                        ->where('year', $year)
                                        ->where('quarter', $quarter)
                                        ->where('status', 'inactive')
                                        ->first();

                                    if ($exists) {
                                        $exists->update(['status' => 'active']);
                                    } else {
                                        PermissionSubModules::insert([
                                            'access_policy_id' => $access_policy_id,
                                            'submodule_id' => $sub_modules_id,
                                            'market_id' => $market_id,
                                            'sub_market_id' => $sub_market_id,
                                            'year' => $year,
                                            'quarter' => $quarter,
                                            'status' => 'active'
                                        ]);
                                    }
                                }
                            }
                            break;
                    }
                }
            }
        }

        return response()->json(['message' => 'Permissions updated successfully!']);
    }

    public function destroy($access_policy_id)
    {
        // Desactivar todos los permisos (soft delete)
        PermissionsUnique::where('access_policy_id', $access_policy_id)
            ->update(['status' => 'inactive']);

        PermissionPolicies::where('access_policy_id', $access_policy_id)
            ->update(['status' => 'inactive']);

        PermissionSubModules::where('access_policy_id', $access_policy_id)
            ->update(['status' => 'inactive']);

        return response()->json(['message' => 'Permissions deleted successfully!']);
    }
}
