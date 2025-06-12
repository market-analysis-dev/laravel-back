<?php

namespace App\Http\Controllers;

// use App\Models\User;
use App\Http\Resources\UserResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Support\Facades\Hash;

// use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{
    public function login(Request $request): \App\Responses\ApiResponse
    {
        // * Validar los datos de entrada
        $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('user_name', 'password');

        // * Intentar autenticar el usuario
        if (!Auth::attempt($credentials)) {
            return $this->error('Invalid credentials', status: 401);
        }

        $user = new UserResource(Auth::user());

        // * Generar el token de acceso
        $token = $user->createToken('market-analysis')->plainTextToken;
        $company = optional(Company::find($user->company_id));

        return $this->success('Login successful', $user, [
            'access_token' => $token,
        ]);
    }

    public function me()
    {
        $user = new UserResource(Auth::user());
        $permissions = $user->getAllPermissions()->pluck('name');
        return $this->success('I am', compact('user', 'permissions'));
    }
}
