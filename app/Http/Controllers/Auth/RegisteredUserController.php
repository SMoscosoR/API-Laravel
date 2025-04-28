<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisteredUserController extends Controller
{
    public function store(RegisteredUserRequest $request)
    {
        // Crea un nuevo usuario con los datos validados
        $user = User::create([
            'name'     => $request->validated()['name'],
            'email'    => $request->validated()['email'],
            'password' => Hash::make($request->validated()['password']), // Encriptamos la contraseña
        ]);

        // Devolvemos el usuario creado con un código 201
        return new JsonResponse($user, Response::HTTP_CREATED);
    }
}