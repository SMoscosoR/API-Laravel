<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::truncate();

        // Los roles se asignan después de crear el usuario
        $users = [
            ['name' => 'Admin', 'email' => 'admin@example.com', 'password' => Hash::make('password'), 'role' => 'admin'],
            ['name' => 'Cliente 1', 'email' => 'cliente1@example.com', 'password' => Hash::make('password'), 'role' => 'cliente'],
            ['name' => 'Cliente 2', 'email' => 'cliente2@example.com', 'password' => Hash::make('password'), 'role' => 'cliente'],
        ];

        foreach ($users as $data) {
            // Crear el usuario sin el campo 'role'
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);

            // Asignar el rol después de crear el usuario
            $user->assignRole($data['role']);
        }
    }
}