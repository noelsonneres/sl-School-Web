<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;
use App\Models\Aluno;
use App\Models\Responsavel;
use App\Models\Consultor;

class Matricula extends Model
{
    use HasFactory;

    public function cursos(){
        return $this->belongsTo(Curso::class, 'cursos_id');
    }

    public function alunos(){
        return $this->belongsTo(Aluno::class, 'alunos_id');
    }

    public function responsaveis(){
        return $this->belongsTo(Responsavel::class, 'responsavels_id');
    }

    public function consultores(){
        return $this->belongsTo(Consultor::class, 'consultors_id');
    }

}
