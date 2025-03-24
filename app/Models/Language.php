<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['name']; // Solo el nombre del idioma
    public function students()
    {
        return $this->belongsToMany(Student::class, 'language_student'); // Especifica la tabla intermedia si es necesario
    }
}