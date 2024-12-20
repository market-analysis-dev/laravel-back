<?php
namespace App\Http\Controllers;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller //  implements HasMiddleware
{
    // public static function middleware()
    // {
    //     return [
    //         new Middleware('permission:roles.index', only: ['index', 'show']),
    //         new Middleware('permission:roles.create', only: ['store']),
    //         new Middleware('permission:roles.edit', only: ['update']),
    //         new Middleware('permission:roles.destroy', only: ['destroy'])
    //     ];
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Role::orderBy('name')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        return Role::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show($roleId)
    {
        $role = Role::firstOrFail($roleId);
        return $role;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $roleId)
    {
        $role = Role::firstOrFail($roleId);

        $validated = $request->validate([
            'name' => 'required'
        ]);
        return $role::update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roleId)
    {
        $role = Role::firstOrFail($roleId);
        return $role->destroy();
    }
}
