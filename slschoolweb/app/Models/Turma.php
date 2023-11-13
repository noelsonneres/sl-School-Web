<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CadastroDia;
use App\Models\CadastroHorario;
use App\Models\Sala;
use App\Models\Professor;

class Turma extends Model
{
    use HasFactory;

    public function dias()
    {
        return $this->belongsTo(CadastroDia::class, 'cadastro_dias_id');
    }

    public function horarios(){
        return $this->belongsTo(CadastroHorario::class, 'cadastro_horarios_id');
    }

    public function cadastroDias(){
        return $this->belongsTo(CadastroDia::class, 'cadastro_dias_id');
    }

    public function cadastroHorarios(){
        return $this->belongsTo(CadastroHorario::class, 'cadastro_horarios_id');
    }

    public function sala(){
        return $this->belongsTo(Sala::class, 'salas_id');
    }

    public function professor(){
        return $this->belongsTo(Professor::class, 'professors_id');
    }

}
