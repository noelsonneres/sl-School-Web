<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Disciplina;

class MatriculaDisciplina extends Model
{
    use HasFactory;

    public function disciplinas()
    {
        return $this->belongsTo(Disciplina::class, 'disciplinas_id');
    }

    public function cursos(){
        return $this->belongsTo(Curso::class, 'cursos_id');
    }

}
