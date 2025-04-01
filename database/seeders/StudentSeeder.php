<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['name' => 'Juan Pérez', 'email' => 'juan@example.com', 'phone' => '987543213'],
            ['name' => 'María López', 'email' => 'maria@example.com', 'phone' => '987653212'],
            ['name' => 'Carlos Ramírez', 'email' => 'carlos@example.com', 'phone' => '987654321'],
            ['name' => 'Ana González', 'email' => 'ana@example.com', 'phone' => '987654324'],
            ['name' => 'Pedro Sánchez', 'email' => 'pedro@example.com', 'phone' => '976543215']
        ];

        foreach ($students as $student) {
            Student::firstOrCreate($student);
        }
    }
}
