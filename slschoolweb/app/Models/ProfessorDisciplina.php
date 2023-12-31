<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Professor;
use App\Models\Disciplina;

class ProfessorDisciplina extends Model
{
    use HasFactory;

    public function disciplinas(){
        return $this->belongsTo(Disciplina::class, 'disciplinas_id');
    }

}
