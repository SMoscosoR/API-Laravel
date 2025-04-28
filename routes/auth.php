<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'middleware' => 'guest'
], static function () {
    Route::post('login', [AuthenticatedController::class, 'store']);
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::group([
    'middleware' => 'auth:sanctum'
], static function () {
    Route::delete('logout', [AuthenticatedController::class, 'destroy']);
});