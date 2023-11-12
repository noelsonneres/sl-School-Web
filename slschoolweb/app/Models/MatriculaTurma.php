<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Turma;

class MatriculaTurma extends Model
{
    use HasFactory;

    public function turmas(){
        return $this->belongsToMany(Turma::class, 'turmas_id');
    }

}
