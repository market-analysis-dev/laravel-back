<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class MarketAuthController
{
    public function login(Request $request)
    {
        $request->validate([
            'userName' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('userName', $request->userName)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if(!Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Invalid password.'], 401);
        }

        // * Determinar el tipo de dispositivo
        // $deviceType = $this->getDeviceName($request);
        $deviceType = $request->header('User-Agent');

        // * Validar el número de pantallas disponibles
        $activeSessions = DB::table('personal_access_tokens')
            ->where('tokenable_id', $user->id)
            ->count();

        if ($activeSessions >= $user->totalScreens) {
            return response()->json(['message' => 'You have reached the maximum number of available screens, please contact your provider.'], 403);
        }

        // * Buscar si ya existe un token para este dispositivo
        $existinToken = DB::table('personal_access_tokens')
            ->where('tokenable_id', $user->id)
            ->where('name', $deviceType)
            ->first();

        if ($existinToken) {
            // * Si existe, simplemente devuelve el token
            return response()->json(['access_token' => $existinToken->token, 'token_type' => 'Bearer']);
        }

        // * Si no existe, crea un nuevo token
        $token = $user->createToken('auth_token', ['name' => $deviceType])->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    // * Método para determinar el tipo de dispositivo
    // private function getDeviceName(Request $request)
    // {
    //     $agent = new Agent();

    //     // * Si es un dispositivo móvil, obtén el nombre
    //     if($agent->isMobile()) {
    //         return $agent->device(); // * Devuelve el nombre del dispositivo móvil
    //     }

    //     // * Para dispositivos de escritorio, obtener el nombre del sistema operativo
    //     return $agent->platform() . ' ' . $agent->version($agent->platform());
    // }
}
