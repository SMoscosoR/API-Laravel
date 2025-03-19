<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Si necesitas crear usuarios de prueba, puedes descomentar esto:
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Llamar a los seeders
        $this->call([
            StudentSeeder::class,
            LanguageSeeder::class
        ]);
    }
}