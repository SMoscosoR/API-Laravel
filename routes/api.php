<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\LanguageController;
use Illuminate\Support\Facades\Route;

// Rutas para estudiantes
Route::apiResource('students', StudentController::class)->except(['store']);

Route::post('/students', [StudentController::class, 'storeOrRestore'])->name('students.storeOrRestore');
Route::get('/students/trashed', [StudentController::class, 'trashed'])->name('students.trashed');
Route::delete('/students/force-delete/{student}', [StudentController::class, 'forceDelete'])->name('students.forceDelete');
Route::post('/students/{student}/languages', [StudentController::class, 'assignLanguages'])->name('students.assignLanguages');

// Rutas para idiomas
Route::apiResource('languages', LanguageController::class)->except(['store']);

Route::post('/languages', [LanguageController::class, 'storeOrRestore'])->name('languages.storeOrRestore');
Route::get('/languages/trashed', [LanguageController::class, 'trashed'])->name('languages.trashed');
Route::delete('/languages/force-delete/{language}', [LanguageController::class, 'forceDelete'])->name('languages.forceDelete');
