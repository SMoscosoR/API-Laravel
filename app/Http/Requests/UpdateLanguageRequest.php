<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permitir la solicitud sin restricciones
    }

    public function rules(): array
    {
        $id = $this->route('language')->id ?? null; // Obtener el ID del idioma desde la ruta

        return [
            'name' => 'required|string|max:255|unique:languages,name,' . $id // Asegura que el nombre sea único excepto en este idioma
        ];
    }
}
