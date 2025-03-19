<?php

use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;

Route::apiResource('students', StudentController::class);

Route::get('/students/{student}', [StudentController::class, 'show']);
Route::put('/students/{student}', [StudentController::class, 'update']);
Route::patch('/students/{student}', [StudentController::class, 'updatePartial']);
Route::delete('/students/{student}', [StudentController::class, 'destroy']);

// Ruta para asignar idiomas a un estudiante
use App\Http\Controllers\Api\LanguageController;

Route::apiResource('languages', LanguageController::class);
Route::post('/students/{student}/languages', [StudentController::class, 'assignLanguages']);