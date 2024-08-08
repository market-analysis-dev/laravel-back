<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'companyId' => 36,
            'userTypeId' => 'required|exists:usertypes,id',
            'totalScreens' => 0,
            'status' => 'required|in:Activo,Inactivo',
        ]);

        return User::create($request->all());
    }

    public function getUsers()
    {
        $users = User::where('status', 'Activo')
            ->where('userTypeId', '!=', 2)
            ->get();

        return response()->json($users);
    }
}
