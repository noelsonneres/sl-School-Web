<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Responsavel;
use App\Models\Matricula;

class Mensalidade extends Model
{
    use HasFactory;

    public function alunos()
    {
        return $this->belongsTo(Aluno::class, 'alunos_id');
    }

    public function matriculas()
    {
        return $this->belongsTo(Matricula::class, 'matriculas_id');
    }

    public function cursos()
    {
        return $this->belongsTo(Curso::class, 'cursos_id');
    }

    public function responsaveis()
    {
        return $this->belongsTo(Responsavel::class, 'responsavels_id');
    }
}
