<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Aseguramos que los roles existen
        $adminRole = Role::where('name', 'admin')->first();
        $clienteRole = Role::where('name', 'cliente')->first();

        // Permisos para students
        Permission::create(['name' => 'students.index'])->syncRoles([$adminRole, $clienteRole]);
        Permission::create(['name' => 'students.show'])->syncRoles([$adminRole, $clienteRole]);
        Permission::create(['name' => 'students.store'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'students.update'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'students.destroy'])->syncRoles([$adminRole]);

        // Permisos para languages
        Permission::create(['name' => 'languages.index'])->syncRoles([$adminRole, $clienteRole]);
        Permission::create(['name' => 'languages.show'])->syncRoles([$adminRole, $clienteRole]);
        Permission::create(['name' => 'languages.store'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'languages.update'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'languages.destroy'])->syncRoles([$adminRole]);

        // Permisos para users
        Permission::create(['name' => 'users.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'users.show'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'users.store'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'users.update'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'users.destroy'])->syncRoles([$adminRole]);
    }
}