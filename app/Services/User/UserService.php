<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    /**
     * Obtener todos los usuarios
     *
     * @return JsonResponse
     */
    public function getAllUsers(): JsonResponse
    {
        $users = User::whereNull('deleted_at')->get();
        return response()->json([
            'users' => $users,
            'status' => 200
        ], 200);
    }

    /**
     * Crear o restaurar un usuario
     *
     * @param array $data
     * @return JsonResponse
     */
    public function storeOrRestore(array $data): JsonResponse
    {
        $user = User::withTrashed()->firstOrNew(['email' => $data['email']]);

        if ($user->exists) {
            if ($user->trashed()) {
                $user->restore();
                return response()->json([
                    'message' => 'El usuario fue restaurado',
                    'data' => $user->fresh()
                ], Response::HTTP_OK);
            }

            return response()->json(['message' => 'El usuario ya existe'], Response::HTTP_CONFLICT);
        }

        $data['password'] = bcrypt($data['password']);
        $user->fill($data);
        $user->save();

        return response()->json([
            'message' => 'El usuario ha sido creado',
            'data' => $user
        ], Response::HTTP_CREATED);
    }

    /**
     * Actualizar usuario
     *
     * @param array $data
     * @param User $user
     * @return JsonResponse
     */
    public function updateUser(array $data, User $user): JsonResponse
    {
        $user->update($data);
        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'user' => $user
        ], 200);
    }

    /**
     * Eliminar usuario (Soft Delete)
     *
     * @param User $user
     * @return JsonResponse
     */
    public function deleteUser(User $user): JsonResponse
    {
        $user->delete(); // Soft delete
        return response()->json([
            'message' => 'Usuario enviado a la papelera'
        ], 200);
    }
}