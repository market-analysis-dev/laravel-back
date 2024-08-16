<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('users.status', 'Activo')
            ->select('users.id', 'users.name', 'users.lastName', 'users.middleName', 'users.userName', 'companies.nameCompany', 'usertypes.typeName', 'users.totalScreens', 'users.status')
            ->leftJoin('companies', 'users.companyId', '=', 'companies.id')
            ->leftJoin('usertypes', 'users.userTypeId', '=', 'usertypes.id')
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
            'middleName' => 'nullable|string|max:255',
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

            DB::table('admin_modules_permissions')->insert([
                'userId' => $userId,
                'moduleId' => $moduleId,
                'status' => 'Activo'
            ]);
        }

        // * Si es de campo, se dan permisos de buildings
        switch ($userTypeId) {
            case 5:
                
                foreach ($markets as $key => $marketId) {
                    
                    DB::table('admin_buildings_permissions')->insert([
                        'userId' => $userId,
                        'marketId' => $marketId,
                        'status' => 'Activo'
                    ]);
                }

            break;
        }
    }

    public function getEmployees()
    {
        $users = User::where('users.status', 'Activo')
            ->select('users.id', 'users.name', 'users.lastName', 'users.middleName', 'users.userName', 'companies.nameCompany', 'usertypes.typeName', 'users.totalScreens', 'users.status')
            ->leftJoin('companies', 'users.companyId', '=', 'companies.id')
            ->leftJoin('usertypes', 'users.userTypeId', '=', 'usertypes.id')
            ->where('userTypeId', '!=', 2)
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
        $allModules = DB::table('admin_modules')
            ->select('id', 'moduleName')
            ->where('status', 'Activo')
            ->get();

        foreach ($allModules as $key => $moduleData) {

            $cleanArray = array(
                'value' => $moduleData->id,
                'label' => $moduleData->moduleName,
                'selected' => false,
                'options' => []
            );

            $existModulesPermission = DB::table('admin_modules_permissions')
                ->where('userId', $userId)
                ->where('moduleId', $moduleData->id)
                ->where('status', 'Activo')
                ->exists();

            if ($existModulesPermission) {
                $cleanArray['selected'] = true;
            }

            array_push($modulesPermissions, $cleanArray);
        }

        // * obteniendo todos los userTypes
        $allUserTypes = DB::table('usertypes')
            ->select('id', 'typeName')
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
                $allMarkets = DB::table('markets')
                    ->select('id', 'marketName')
                    ->where('status', 'Activo')
                    ->get();

                foreach ($allMarkets as $key => $marketData) {
                    $cleanArray = array(
                        'value' => $marketData->id,
                        'label' => $marketData->marketName,
                        'selected' => false,
                        'options' => []
                    );
        
                    $existBuildingsPermission = DB::table('admin_buildings_permissions')
                        ->where('userId', $userId)
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
        exit;

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
            DB::table('users')
                ->where('id', $userId)
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
            DB::table('users')
                ->where('id', $userId)
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
        DB::table('admin_modules_permissions')
            ->where('userId', $userId)
            ->update(['status' => 'Inactivo']);

        // * Permisos de modulos por usuario.
        foreach ($modules as $key => $moduleId) {

            $exist = DB::table('admin_modules_permissions')
                ->where('userId', $userId)
                ->where('moduleId', $moduleId)
                ->exists();

            if ($exist) {
                
                DB::table('admin_modules_permissions')
                    ->where('userId', $userId)
                    ->where('moduleId', $moduleId)
                    ->update(['status' => 'Activo']);

            } else {

                DB::table('admin_modules_permissions')->insert([
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
                DB::table('admin_buildings_permissions')
                    ->where('userId', $userId)
                    ->update(['status' => 'Inactivo']);
                
                foreach ($markets as $key => $marketId) {

                    $exist = DB::table('admin_buildings_permissions')
                        ->where('userId', $userId)
                        ->where('marketId', $marketId)
                        ->exists();

                    if ($exist) {
                        DB::table('admin_buildings_permissions')
                            ->where('userId', $userId)
                            ->where('marketId', $marketId)
                            ->update(['status' => 'Activo']);
                        
                    } else {

                        DB::table('admin_buildings_permissions')->insert([
                            'userId' => $userId,
                            'marketId' => $marketId,
                            'status' => 'Activo'
                        ]);
                    }
                }

            break;
        }     
    }
}
