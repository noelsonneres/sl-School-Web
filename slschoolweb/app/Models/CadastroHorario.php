<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Turma;

class CadastroHorario extends Model
{
    use HasFactory;

    public function cadastroHorarios(){
        return $this->hasMany(Turma::class, 'cadasrto_horarios_id');
    }


}
