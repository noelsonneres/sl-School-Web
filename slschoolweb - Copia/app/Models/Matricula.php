<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Aluno;

class Matricula extends Model
{
    use HasFactory;

    public function cursos(){
        return $this->belongsTo(Curso::class, 'cursos_id');
    }

    public function alunos(){
        return $this->belongsTo(Aluno::class, 'alunos_id');
    }

}
