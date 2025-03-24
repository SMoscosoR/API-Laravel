<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permitir que todos puedan hacer esta solicitud
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:languages,name', // El nombre del idioma debe ser único
        ];
    }
}
