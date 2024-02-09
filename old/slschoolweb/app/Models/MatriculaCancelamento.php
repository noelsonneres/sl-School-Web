<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;
use App\Models\Matricula;

class MatriculaCancelamento extends Model
{
    use HasFactory;

    public function alunos(){
        return $this->belongsTo(Aluno::class, 'alunos_id');
    }

    public function matriculas(){
      return $this->belongsTo(Matricula::class, 'matriculas_id');
    }

}
