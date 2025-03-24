<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LanguageController extends Controller
{
    /**
     * Listar todos los idiomas.
     */
    public function index(): JsonResponse
    {
        return response()->json(Language::all(), Response::HTTP_OK);
    }

    /**
     * Guardar un nuevo idioma.
     */
    public function store(StoreLanguageRequest $request): JsonResponse
    {
        $language = Language::create($request->validated());

        return response()->json([
            'message' => 'Idioma creado correctamente',
            'language' => $language
        ], Response::HTTP_CREATED);
    }

    /**
     * Mostrar un idioma específico con Route Model Binding.
     */
    public function show(Language $language): JsonResponse
    {
        return response()->json($language, Response::HTTP_OK);
    }

    /**
     * Actualizar un idioma con Route Model Binding.
     */
    public function update(UpdateLanguageRequest $request, Language $language): JsonResponse
    {
        $language->update($request->validated());

        return response()->json([
            'message' => 'Idioma actualizado correctamente',
            'language' => $language
        ], Response::HTTP_OK);
    }

    /**
     * Eliminar un idioma con Route Model Binding.
     */
    public function destroy(Language $language): JsonResponse
    {
        $language->delete();

        return response()->json([
            'message' => 'Idioma eliminado correctamente'
        ], Response::HTTP_OK);
    }
}
