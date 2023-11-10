<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;

class Matricula extends Model
{
    use HasFactory;

    public function cursos(){
        return $this->belongsTo(Curso::class, 'cursos_id');
    }

}
