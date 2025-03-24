<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $languages = [
            ['name' => 'Español'],
            ['name' => 'Inglés'],
            ['name' => 'Francés'],
            ['name' => 'Alemán'],
            ['name' => 'Italiano']
        ];

        foreach ($languages as $language) {
            Language::firstOrCreate(['name' => $language['name']], $language);
        }        
    }
}