<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userType = UserType::where('status', 'Activo')->get();
        return response()->json($userType);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'typeName' => 'required|string|max:255',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        return UserType::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $userType = UserType::find($id);

        if (!$userType) {
            return response()->json(['message' => 'User Type not found', 404]);
        }

        return response()->json($userType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'typeName' => 'required|string|max:255',
            'status' => 'required|in:Activo,Inactivo',
        ]);

        $userType = UserType::findOrFail($id);
        $userType->update($request->all());

        return response()->json($userType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $userType = UserType::findOrFail($id);

        $userType->status = 'Inactivo';
        $userType->save();

        return response()->json(['message' => 'Usert Type eliminado correctamente']);
    }
}
