<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UpdateStudentPartialRequest;
use App\Models\Student;
use App\Services\Student\StudentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    protected StudentService $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index(): JsonResponse
    {
        return $this->studentService->getAllStudents();
    }

    public function storeOrRestore(StoreStudentRequest $request): JsonResponse
    {
        $response = $this->studentService->storeOrRestore($request->validated());
        return $response;
    }

    public function show(Student $student): JsonResponse
    {
        return response()->json($student->load('languages'));
    }

    public function update(UpdateStudentRequest $request, Student $student): JsonResponse
    {
        $response = $this->studentService->updateStudent($request->validated(), $student);
        return $response;
    }

    public function updatePartial(UpdateStudentPartialRequest $request, Student $student): JsonResponse
    {
        $response = $this->studentService->updateStudentPartial($request->validated(), $student);
        return $response;
    }

    public function destroy(Student $student): JsonResponse
    {
        $response = $this->studentService->deleteStudent($student);
        return $response;
    }

    public function trashed(): JsonResponse
    {
        return response()->json([
            'message' => 'Lista de estudiantes eliminados obtenida correctamente',
            'students' => Student::onlyTrashed()->get()
        ], Response::HTTP_OK);
    }

    public function forceDelete(Student $student): JsonResponse
    {
        $student->forceDelete();
        return response()->json([
            'message' => 'Estudiante eliminado permanentemente'
        ], Response::HTTP_OK);
    }

    public function assignLanguages(Request $request, Student $student): JsonResponse
    {
        $student->languages()->sync($request->languages);
        return response()->json([
            'message' => 'Idiomas asignados correctamente',
            'student' => $student->load('languages')
        ], Response::HTTP_OK);
    }
}