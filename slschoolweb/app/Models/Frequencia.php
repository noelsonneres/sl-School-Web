<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\Disciplina;
use App\Models\Turma;

class Frequencia extends Model
{
    use HasFactory;

    public function alunos(){
        return $this->belongsTo(Aluno::class, 'alunos_id');
    }

    public function matriculas(){
        return $this->belongsTo(Matricula::class, 'matriculas_id');
    }

    public function disciplinas(){
        return $this->belongsTo(Disciplina::class, 'disciplinas_id');
    }

    public function turmas(){
        return $this->belongsTo(Turma::class, 'turmas_id');
    }

}
