<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matricula;
use App\Models\Turma;

class MatriculaTurma extends Model
{
    use HasFactory;

    public function matriculas(){
        return $this->belongsTo(Matricula::class, 'matriculas_id');
    }

    public function turmas(){
        return $this->belongsTo(Turma::class, 'turmas_id');
    }

}
