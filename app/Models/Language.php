<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;
    protected $fillable = ['name']; // Solo el nombre del idioma
    public function students()
    {
        return $this->belongsToMany(Student::class, 'language_student'); // Especifica la tabla intermedia si es necesario
    }
}