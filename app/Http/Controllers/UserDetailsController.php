<?php

namespace App\Http\Controllers;

use App\Models\UserDetails;
use Illuminate\Http\Request;

class UserDetailsController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userDetail = UserDetails::where('status', 'Activo')->get();
        return response()->json($userDetail);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'companyId' => 'required|exists:companies,id',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'profileImage' => 'nullable|string|max:255',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'status' => 'required|in:Activo,Inactivo',
            'emailAddress' => 'required|email|max:255|unique:userdetails,emailAddress',
            'phoneNumber' => 'nullable|string|max:20|unique:userdetails,phoneNumber',
        ]);

        return UserDetails::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $userDetail = UserDetails::find($id);

        if (!$userDetail) {
            return response()->json(['message' => 'Details not found'], 404);
        }

        return response()->json($userDetail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'companyId' => 'required|exists:companies,id',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'profileImage' => 'nullable|string|max:255',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'status' => 'required|in:Activo,Inactivo',
            'emailAddress' => 'required|email|max:255|unique:userdetails,emailAddress,' . $id,
            'phoneNumber' => 'nullable|string|max:20|unique:userdetails,phoneNumber,' . $id,
        ]);

        $userDetail = UserDetails::findOrFail($id);
        $userDetail->update($request->all());

        return response()->json($userDetail);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userDetail = UserDetails::findOrFail($id);

        $userDetail->status = 'Inactivo';
        $userDetail->save();

        return response()->json(['message' => 'Detalle eliminado correctamente']);
    }
}
