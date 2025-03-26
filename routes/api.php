<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\LanguageController;
use Illuminate\Support\Facades\Route;

// Rutas para estudiantes
Route::apiResource('students', StudentController::class)->except(['store']);
// Crear o Restaurar Estudiante
Route::post('/students', [studentController::class, 'storeOrRestore']);
Route::get('/students/trashed', [StudentController::class, 'trashed'])->name('students.trashed');
Route::delete('/students/force-delete/{id}', [StudentController::class, 'forceDelete']);
Route::post('/students/{student}/languages', [StudentController::class, 'assignLanguages']); 

// Rutas para idiomas
Route::apiResource('languages', LanguageController::class)->except(['store']);
Route::post('/languages', [LanguageController::class, 'storeOrRestore']); // Crear o restaurar idioma
Route::get('/languages/trashed', [LanguageController::class, 'trashed']);
Route::delete('/languages/force-delete/{id}', [LanguageController::class, 'forceDelete']);