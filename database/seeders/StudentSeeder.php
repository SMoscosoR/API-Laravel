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
            ['name' => 'Juan Pérez', 'email' => 'juan@example.com', 'phone' => '9876543213'],
            ['name' => 'María López', 'email' => 'maria@example.com', 'phone' => '9876543212'],
            ['name' => 'Carlos Ramírez', 'email' => 'carlos@example.com', 'phone' => '9876543211'],
            ['name' => 'Ana González', 'email' => 'ana@example.com', 'phone' => '9876543214'],
            ['name' => 'Pedro Sánchez', 'email' => 'pedro@example.com', 'phone' => '9876543215']
        ];

        foreach ($students as $student) {
            Student::firstOrCreate($student);
        }
    }
}
