<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Turma;
use App\Models\CadastroDia;
use App\Models\CadastroHorario;
use App\Models\Sala;
use App\Models\Aluno;

class MatriculaTurma extends Model
{
    use HasFactory;

    public function turmas(){
        return $this->belongsTo(Turma::class, 'turmas_id');

    }

    public function cadastroDias(){
        return $this->belongsTo(CadastroDia::class, 'cadastro_dias_id');
    }

    public function cadastroHorarios(){
        return $this->belongsTo(CadastroHorario::class, 'cadastro_horarios_id');
    }

    public function salas(){
        return $this->belongsTo(Sala::class, 'salas_id');
    }

    public function alunos(){
        return $this->belongsTo(Aluno::class, 'alunos_id');
    }

    public function matriculas(){
        return $this->belongsTo(Matricula::class, 'matriculas_id');
    }

}
