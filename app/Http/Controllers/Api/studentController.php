<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UpdateStudentPartialRequest;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('languages')->get();

        return response()->json([
            'students' => $students
        ], 200);
    }
    
    public function storeOrRestore(StoreStudentRequest $request): JsonResponse
    {
        $data = $request->validated();
        $student = Student::withTrashed()->firstOrNew(['email' => $data['email']]);

        if ($student->exists) {
            if ($student->trashed()) {
                $student->restore();
                return response()->json([
                    'message' => 'El estudiante fue restaurado',
                    'student' => $student->fresh()->load('languages')
                ], Response::HTTP_OK); // 200 OK
            }

            return response()->json(['message' => 'El estudiante ya existe'], Response::HTTP_CONFLICT); // 409 Conflict
        }

        // Si no existía, lo creamos
        $student->fill($data);
        $student->save();

        if ($request->has('languages')) {
            $student->languages()->sync($request->languages);
        }

        return response()->json([
            'message' => 'Estudiante creado correctamente',
            'student' => $student->load('languages')
        ], Response::HTTP_CREATED); // 201 Created
    }

    public function show(Student $student)
    {
        return response()->json([
            'student' => $student->load('languages')
        ], 200);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        if ($request->has('languages')) {
            $student->languages()->sync($request->languages);
        }

        return response()->json([
            'message' => 'Estudiante actualizado correctamente',
            'student' => $student->load('languages')
        ], 200);
    }
    
    public function updatePartial(UpdateStudentPartialRequest $request, Student $student)
    {
        $student->update($request->validated());

        return response()->json([
            'message' => 'Estudiante actualizado parcialmente',
            'student' => $student->load('languages')
        ], 200);
    }

    public function destroy(Student $student)
    {
        $student->languages()->detach();
        $student->delete();

        return response()->json([
            'message' => 'Estudiante eliminado correctamente'
        ], 200);
    }
}