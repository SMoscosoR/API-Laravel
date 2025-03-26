<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permitir que todos puedan hacer esta solicitud
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('languages', 'name')->whereNull('deleted_at') // Permite restaurar si fue eliminado
            ],
        ];
    }
}
