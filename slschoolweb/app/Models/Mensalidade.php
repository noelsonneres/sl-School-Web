<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;

class Mensalidade extends Model
{
    use HasFactory;

    public function alunos(){
        $this->belongsTo(Aluno::class, 'alunos_id');
    }

}
