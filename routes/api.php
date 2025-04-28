<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth:sanctum'
], static function () {
    // Rutas para estudiantes
    Route::apiResource('students', StudentController::class)->except(['store']);
    Route::post('/students', [StudentController::class, 'storeOrRestore'])->name('students.storeOrRestore');
    Route::post('/students/{student}/languages', [StudentController::class, 'assignLanguages'])->name('students.assignLanguages');
    
    // Rutas para idiomas
    Route::apiResource('languages', LanguageController::class)->except(['store']);
    Route::post('/languages', [LanguageController::class, 'storeOrRestore'])->name('languages.storeOrRestore');

    // Rutas para usuarios
    Route::apiResource('users', UserController::class)->except(['store']);
    Route::post('/users', [UserController::class, 'storeOrRestore'])->name('users.storeOrRestore');
});