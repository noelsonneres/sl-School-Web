<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CadastroDia;

class Turma extends Model
{
    use HasFactory;

    public function cadastroDias(){
        return $this->belongsTo(CadastroDia::class, 'cadastro_dias_id');
    }

}
