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
use App\Http\Resources\StudentResource;

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
        return $this->studentService->storeOrRestore($request->validated());
    }

    public function show(Student $student): JsonResponse
    {
        $student->load('languages');
        return response()->json([
            'message' => 'Estudiante encontrado',
            'student' => new StudentResource($student)
        ], Response::HTTP_OK);
    }

    public function update(UpdateStudentRequest $request, Student $student): JsonResponse
    {
        return $this->studentService->updateStudent($request->validated(), $student);
    }

    public function updatePartial(UpdateStudentPartialRequest $request, Student $student): JsonResponse
    {
        return $this->studentService->updateStudentPartial($request->validated(), $student);
    }

    public function destroy(Student $student): JsonResponse
    {
        return $this->studentService->deleteStudent($student);
    }

    public function trashed(): JsonResponse
    {
        $trashed = Student::onlyTrashed()->with('languages')->get();
        return response()->json([
            'message' => 'Lista de estudiantes eliminados obtenida correctamente',
            'students' => StudentResource::collection($trashed)
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
        $student->load('languages');

        return response()->json([
            'message' => 'Idiomas asignados correctamente',
            'student' => new StudentResource($student)
        ], Response::HTTP_OK);
    }
}
