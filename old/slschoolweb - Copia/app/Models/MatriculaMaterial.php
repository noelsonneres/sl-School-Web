<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MateriaisEscolar;

class MatriculaMaterial extends Model
{
    use HasFactory;

    public function material(){
        return $this->belongsTo(MateriaisEscolar::class, 'materiais_escolars_id');
    }

    public function alunos(){
        return $this->belongsTo(Aluno::class, 'alunos_id');
    }

}
