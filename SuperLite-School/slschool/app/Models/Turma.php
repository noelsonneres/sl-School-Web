<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DiasAula;
use App\Models\HorariosAula;
use App\Models\SalaAula;
use App\Models\Professor;

class Turma extends Model
{
    use HasFactory;

    public function dias_aulas(){
        return $this->belongsTo(DiasAula::class, 'dias_aulas_id');
    }

    public function horarios_aulas(){
        return $this->belongsTo(HorariosAula::class, 'horarios_aulas_id');
    }

    public function salas_aulas(){
        return $this->belongsTo(SalaAula::class, 'sala_aulas_id');
    }

    public function professores(){
        return $this->belongsTo(Professor::class, 'professors_id');
    }

}
