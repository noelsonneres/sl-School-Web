<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProfessorDisciplina;

class Professor extends Model
{
    use HasFactory;

    public function disciplinas(){
        return $this->hasMany(ProfessorDisciplina::class, 'professors_id');
    }

}
