<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController
{
    public function login(Request $request)
    {
        try {

            // * Validar los datos de entrada
            $validator = Validator::make($request->all(), [
                'user_name' => 'required|string',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // * Buscar el usuario [por el nombre de usuario]

            $user = User::where('user_name', $request->user_name)
                        ->where('user_type_id', '!=', 2)
                        ->where('status', 'Active')
                        ->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // * Crear el token
            $token = base64_encode(bin2hex(random_bytes(32)));

            // * Guardar el token en la base de datos
            $user->remember_token = $token;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error in login process',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
