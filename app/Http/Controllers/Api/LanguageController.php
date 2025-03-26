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
    public function storeOrRestore(StoreLanguageRequest $request): JsonResponse
    {
        $data = $request->validated();

        $language = Language::withTrashed()->firstOrNew(['name' => $data['name']]);

        if ($language->exists) {
            if ($language->trashed()) {
                $language->restore();
                return response()->json([
                    'message' => 'El idioma fue restaurado correctamente',
                    'data' => $language->fresh()
                ], Response::HTTP_OK);
            }

            return response()->json(['message' => 'El idioma ya existe'], Response::HTTP_CONFLICT);
        }

        $language->fill($data)->save();
        return response()->json($language, Response::HTTP_CREATED);
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
