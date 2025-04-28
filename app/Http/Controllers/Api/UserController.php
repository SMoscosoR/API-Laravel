<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        return $this->userService->getAllUsers();
    }

    public function storeOrRestore(StoreUserRequest $request): JsonResponse
    {
        return $this->userService->storeOrRestore($request->validated());
    }

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'message' => 'Usuario encontrado',
            'user' => new UserResource($user)
        ], Response::HTTP_OK);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        return $this->userService->updateUser($request->validated(), $user);
    }

    public function destroy(User $user): JsonResponse
    {
        return $this->userService->deleteUser($user);
    }
}