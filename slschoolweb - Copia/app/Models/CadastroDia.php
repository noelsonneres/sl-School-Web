<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Turma;

class CadastroDia extends Model
{
    use HasFactory;

    public function cadastroDias(){
        return $this->hasOne(Turma::class, 'cadastro_dias_id');
    }

}
