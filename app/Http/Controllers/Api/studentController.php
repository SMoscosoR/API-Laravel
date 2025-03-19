<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UpdateStudentPartialRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('languages')->get();

        return response()->json([
            'students' => $students
        ], 200);
    }
    
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());

        if ($request->has('languages')) {
            $student->languages()->sync($request->languages); // Verifica que esto se está ejecutando
        }

        return response()->json([
            'message' => 'Estudiante creado correctamente',
            'student' => $student->load('languages')
        ], 201);
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