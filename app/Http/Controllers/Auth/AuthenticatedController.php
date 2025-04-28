<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedController extends Controller
{
    public function store(LoginRequest $request)
    {
        // Extraemos las credenciales de la solicitud
        $credentials = $request->validated(); // Esto obtiene todos los datos validados

        // Intentamos autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Si la autenticación fue exitosa, generamos un token
            $user = Auth::user(); // Obtenemos el usuario autenticado
            $user->tokens()->delete(); // Eliminamos tokens anteriores

            // Generamos un nuevo token y lo devolvemos
            $token = $user->createToken('token')->plainTextToken;

            return new JsonResponse([
                'token' => $token,
            ], Response::HTTP_OK);
        }

        // Si las credenciales son incorrectas, retornamos un error
        return new JsonResponse([ 
            'message' => 'Credenciales inválidas.' 
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function destroy(Request $request)
    {
        // Obtenemos al usuario autenticado
        $user = $request->user();

        // Verificamos si el usuario tiene un token actual
        if ($user) {
            // Eliminamos todos los tokens asociados con este usuario
            $user->tokens->each(function ($token) {
                $token->delete();
            });

            return new JsonResponse([
                'message' => 'Cerró sesión exitosamente.'
            ], Response::HTTP_OK);
        }

        // Si el usuario no está autenticado, retornamos un error
        return new JsonResponse([
            'message' => 'No estás autenticado o no hay sesión activa.'
        ], Response::HTTP_UNAUTHORIZED);
    }
}