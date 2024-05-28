<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AuthController
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            
            // * Successfull auth
            $token = Auth::user()->createToken('accessToken')->accessToken;
            return response()->json(['token' => $token], 200);
        }

        // ! Error Auth
        return response()->json(['error' => 'Credenciales incorrectas'], 401);
    }
}
