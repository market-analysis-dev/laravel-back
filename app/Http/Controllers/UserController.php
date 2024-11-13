<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AdminCatModules;
use App\Models\UserType;
use App\Models\Market;
use App\Models\AdminBuildingsPermissions;
use App\Models\AdminModulesPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('list_users.status', 'Activo')
            ->where('list_users.userTypeId', 2)
            ->select('list_users.id', 'list_users.name', 'list_users.lastName', 'list_users.middleName', 'list_users.userName', 'list_companies.nameCompany', 'admin_cat_user_types.typeName', 'list_users.totalScreens', 'list_users.status')
            ->leftJoin('list_companies', 'list_users.companyId', '=', 'list_companies.id')
            ->leftJoin('admin_cat_user_types', 'list_users.userTypeId', '=', 'admin_cat_user_types.id')
            ->get();

        return response()->json($users);
    }

    public function getUsersFilterCombo(Request $request)
    {
        $multpleUsersId = json_decode($request->multpleUsersId);

        $users = User::where('list_users.status', 'Activo')
            ->where('list_users.userTypeId', 2)
            ->whereNotIn('list_users.id', $multpleUsersId)
            ->select('list_users.id', 'list_users.name', 'list_users.lastName', 'list_users.middleName', 'list_users.userName', 'list_companies.nameCompany', 'admin_cat_user_types.typeName', 'list_users.totalScreens', 'list_users.status')
            ->leftJoin('list_companies', 'list_users.companyId', '=', 'list_companies.id')
            ->leftJoin('admin_cat_user_types', 'list_users.userTypeId', '=', 'admin_cat_user_types.id')
            ->orderBy('list_users.name', 'asc')
            ->get();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'userName' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:255',
            'companyId' => 'required|exists:companies,id',
            'userTypeId' => 'required|exists:usertypes,id',
            'totalScreens' => 'required|integer',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'userName' => 'required|string|max:255|unique:users,userName,' . $id,
            'password' => 'nullable|string|max:255',
            'companyId' => 'required|exists:companies,id',
            'userTypeId' => 'required|exists:usertypes,id',
            'totalScreens' => 'required|integer',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->status = 'Inactivo';
        $user->save();

        return response()->json(['message' => 'Usuario eliminado correctamente.']);
    }


    public function newAdminUser(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            // 'middleName' => 'nullable|string|max:255',
            'userName' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:255',
            'userTypeId' => 'required|exists:usertypes,id',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        $user = User::create($request->all());
        $userId = $user->id;

        $userTypeId = $request->userTypeId;
        $modules = explode(",", $request->modules);
        $markets = explode(",", $request->markets);

        // * Permisos de modulos por usuario.
        foreach ($modules as $key => $moduleId) {

            AdminModulesPermissions::insert([
                'userId' => $userId,
                'moduleId' => $moduleId,
                'status' => 'Activo'
            ]);
        }

        // * Si es de campo, se dan permisos de buildings
        switch ($userTypeId) {
            case 5:
                
                foreach ($markets as $key => $marketId) {
                    
                    AdminBuildingsPermissions::insert([
                        'userId' => $userId,
                        'marketId' => $marketId,
                        'status' => 'Activo'
                    ]);
                }

            break;
        }
    }


    /*
     * MODULO DE EMPLOYEES
    */

    public function getEmployees()
    {
        $users = User::where('list_users.status', 'Activo')
            ->select('list_users.id', 'list_users.name', 'list_users.lastName', 'list_users.middleName', 'list_users.userName', 'list_companies.nameCompany', 'admin_cat_user_types.typeName', 'list_users.totalScreens', 'list_users.status')
            ->leftJoin('list_companies', 'list_users.companyId', '=', 'list_companies.id')
            ->leftJoin('admin_cat_user_types', 'list_users.userTypeId', '=', 'admin_cat_user_types.id')
            ->where('list_users.userTypeId', '!=', 2)
            ->get();

        return response()->json($users);
    }

    public function getEmployeeId($userId)
    {
        $userIdExist = User::find($userId);

        if (!$userIdExist) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $getUserData = User::select('id', 'userTypeId', 'name', 'lastName', 'middleName', 'userName', 'password')
            ->where('id', $userId)
            ->get();

        $userData = [];

        foreach ($getUserData as $key => $data) {
            $userData = array(
                'id' => $data->id,
                'userTypeId' => $data->userTypeId,
                'name' => $data->name,
                'middleName' => $data->middleName,
                'lastName' => $data->lastName,
                'userName' => $data->userName,
                'password' => $data->password,
            );
        }

        // * Almacenando los permisos por módulo del usuario.
        $modulesPermissions = [];

        // * Almacenando los permisos del usuario de campo.
        $buildingsPermissions = [];

        // * Almacenndo los userTypes en combo.
        $userTypesCbo = [];

        // * obteniendo todos los módulos.
        $allModules = AdminCatModules::select('id', 'moduleName')
            ->where('status', 'Activo')
            ->get();

        foreach ($allModules as $key => $moduleData) {

            $cleanArray = array(
                'value' => $moduleData->id,
                'label' => $moduleData->moduleName,
                'selected' => false,
                'options' => []
            );

            $existModulesPermission = AdminModulesPermissions::where('userId', $userId)
                ->where('moduleId', $moduleData->id)
                ->where('status', 'Activo')
                ->exists();

            if ($existModulesPermission) {
                $cleanArray['selected'] = true;
            }

            array_push($modulesPermissions, $cleanArray);
        }

        // * obteniendo todos los userTypes
        $allUserTypes = UserType::select('id', 'typeName')
            ->where('status', 'Activo')
            ->get();

        foreach ($allUserTypes as $key => $userType) {

            $cleanArray = array(
                'value' => $userType->id,
                'label' => $userType->typeName,
                'selected' => false,
                'options' => []
            );

            if ($userType->id == $userData['userTypeId']) {
                $cleanArray['selected'] = true;
            }

            array_push($userTypesCbo, $cleanArray);   
        }

        // * validando si es userTypeId = 5.
        switch ($userData['userTypeId']) {
            case 5:
                
                // * obteniendo todos los mercados
                $allMarkets = Market::select('id', 'marketName')
                    ->where('status', 'Activo')
                    ->get();

                foreach ($allMarkets as $key => $marketData) {
                    $cleanArray = array(
                        'value' => $marketData->id,
                        'label' => $marketData->marketName,
                        'selected' => false,
                        'options' => []
                    );
        
                    $existBuildingsPermission = AdminBuildingsPermissions::where('userId', $userId)
                        ->where('marketId', $marketData->id)
                        ->where('status', 'Activo')
                        ->exists();
        
                    if ($existBuildingsPermission) {
                        $cleanArray['selected'] = true;
                    }
        
                    array_push($buildingsPermissions, $cleanArray);
                }
                
            break;
        }

        $userData['modules'] = $modulesPermissions;
        $userData['markets'] = $buildingsPermissions;
        $userData['userTypes'] = $userTypesCbo;

        return response()->json($userData);
    }

    public function updateEmployee(Request $request)
    {
        $userId = $request->employeeId;
        $name = $request->name;
        $middleName = $request->middleName;
        $lastName = $request->lastName;
        $userName = $request->userName;
        $password = $request->password;
        $userTypeId = $request->userTypeId;

        $modules = explode(",", $request->modules);
        $markets = explode(",", $request->markets);

        // * Actualizando la información general del empleado
        if ($password != "") {
            # code...
            User::where('id', $userId)
                ->update([
                    'name' => $name,
                    'lastName' => $lastName,
                    'middleName' => $middleName,
                    'userName' => $userName,
                    'password' => $password,
                    'companyId' => 36,
                    'totalScreens' => 0,
                    'status' => 'Activo',
                    'userTypeId' => $userTypeId
                ]);
        } else {
            User::where('id', $userId)
                ->update([
                    'name' => $name,
                    'lastName' => $lastName,
                    'middleName' => $middleName,
                    'userName' => $userName,
                    'companyId' => 36,
                    'totalScreens' => 0,
                    'status' => 'Activo',
                    'userTypeId' => $userTypeId
                ]);
        }

        // * Cambiando todos los permisos de modulos a Inactivo.
        AdminModulesPermissions::where('userId', $userId)
            ->update(['status' => 'Inactivo']);

        // * Permisos de modulos por usuario.
        foreach ($modules as $key => $moduleId) {

            $exist = AdminModulesPermissions::where('userId', $userId)
                ->where('moduleId', $moduleId)
                ->exists();

            if ($exist) {
                
                AdminModulesPermissions::where('userId', $userId)
                    ->where('moduleId', $moduleId)
                    ->update(['status' => 'Activo']);

            } else {

                AdminModulesPermissions::insert([
                    'userId' => $userId,
                    'moduleId' => $moduleId,
                    'status' => 'Activo'
                ]);
            }
        }

        // * Si es de campo, se dan permisos de buildings
        switch ($userTypeId) {
            case 5:

                // * Cambiando todos los permisos de buildings a Inactivo.
                AdminBuildingsPermissions::where('userId', $userId)
                    ->update(['status' => 'Inactivo']);
                
                foreach ($markets as $key => $marketId) {

                    $exist = AdminBuildingsPermissions::where('userId', $userId)
                        ->where('marketId', $marketId)
                        ->exists();

                    if ($exist) {
                        AdminBuildingsPermissions::where('userId', $userId)
                            ->where('marketId', $marketId)
                            ->update(['status' => 'Activo']);
                        
                    } else {

                        AdminBuildingsPermissions::insert([
                            'userId' => $userId,
                            'marketId' => $marketId,
                            'status' => 'Activo'
                        ]);
                    }
                }

            break;
        }     
    }

    public function getUserDevice()
    {
        // $agent = new Agent();
        // $device = $agent->device();
        // $platform = $agent->platform();
        // $browser = $agent->browser();

        // echo "This device: $device \n";
        // echo "This platform: $platform \n";
        // echo "This browser: $browser \n";
    }
}
