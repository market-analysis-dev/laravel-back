<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AuthController
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'userName' => 'required|string',
                'password' => 'required|string',
            ]);

            $user = User::where('userName', $request->userName)
                        ->where('userTypeId', '!=', 2)
                        ->where('status', 'Activo')
                        ->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Credenciales incorrectas o usuario no autorizado'
                ], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error en el proceso de login',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function loginV2(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Credenciales incorrectas o usuario no autorizado'
                ], Response::HTTP_UNAUTHORIZED);
            }

            $token = $user->createToken("auth_token_{$user->id}")->plainTextToken;

            return response()->json([
                'success' => true,
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error en el proceso de login',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
