<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matricula;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Disciplina;

class MatriculaDisciplina extends Model
{
    use HasFactory;

    public function matriculas(){
        return $this->belongsTo(Matricula::class, 'matriculas_id');
    }
    
    public function alunos(){
        return $this->belongsTo(Aluno::class, 'alunos_id');
    }

    public function curso(){
        return $this->belongsTo(Curso::class, 'cursos_id');
    }

    public function disciplinas(){
        return $this->belongsTo(Disciplina::class, 'disciplinas_id');
    }
}
