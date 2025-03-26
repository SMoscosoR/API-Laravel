<?php

namespace App\Http\Requests;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('students', 'email')->whereNull('deleted_at') // Ignora los eliminados
            ],
            'phone' => 'required|digits:10',
            'languages' => 'array',
            'languages.*' => 'exists:languages,id'
        ];
    }
}