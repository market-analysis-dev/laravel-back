<?php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:roles.index', only: ['index', 'show']),
            new Middleware('permission:roles.create', only: ['store']),
            new Middleware('permission:roles.update', only: ['update']),
            new Middleware('permission:roles.destroy', only: ['destroy'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('name')->get();
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer'
        ]);
        $role = Role::create($validated);
        $role->syncPermissions($validated['permissions']);
        return response()->json($role);
    }

    /**
     * Display the specified resource.
     */
    public function show($roleId)
    {
        $role = Role::with(['permissions'])->findOrFail($roleId);
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);

        $validated = $request->validate([
            'name' => 'required',
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer'
        ]);
        $role->update($validated);
        $role->syncPermissions($validated['permissions']);
        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();
        return response()->json($role);
    }
}
