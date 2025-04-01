<?php

namespace App\Services\Student;

use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StudentService
{
    public function getAllStudents(): JsonResponse
    {
        return response()->json([
            'message' => 'Lista de estudiantes obtenida correctamente',
            'students' => Student::with('languages')->get()
        ], Response::HTTP_OK);
    }

    public function storeOrRestore(array $data): JsonResponse
    {
        $student = Student::withTrashed()->firstOrNew(['email' => $data['email']]);

        if ($student->exists) {
            if ($student->trashed()) {
                $student->restore();
                return response()->json([
                    'message' => 'El estudiante fue restaurado',
                    'student' => $student->fresh()->load('languages')
                ], Response::HTTP_OK);
            }

            return response()->json(['message' => 'El estudiante ya existe'], Response::HTTP_CONFLICT);
        }

        // Crear nuevo estudiante
        $student->fill($data);
        $student->save();

        if (isset($data['languages'])) {
            $student->languages()->sync($data['languages']);
        }

        return response()->json([
            'message' => 'Estudiante creado correctamente',
            'student' => $student->load('languages')
        ], Response::HTTP_CREATED);
    }

    public function updateStudent(array $data, Student $student): JsonResponse
    {
        $student->update($data);

        if (isset($data['languages'])) {
            $student->languages()->sync($data['languages']);
        }

        return response()->json([
            'message' => 'Estudiante actualizado correctamente',
            'student' => $student->load('languages')
        ], Response::HTTP_OK);
    }

    public function updateStudentPartial(array $data, Student $student): JsonResponse
    {
        $student->update($data);

        return response()->json([
            'message' => 'Estudiante actualizado parcialmente',
            'student' => $student->load('languages')
        ], Response::HTTP_OK);
    }

    public function deleteStudent(Student $student): JsonResponse
    {
        $student->languages()->detach();
        $student->delete();

        return response()->json([
            'message' => 'Estudiante eliminado correctamente'
        ], Response::HTTP_OK);
    }
}