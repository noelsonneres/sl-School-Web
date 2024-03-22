<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;
use App\Models\ResponsavelAluno;
use App\Models\Matricula;
use App\Models\FormasPagamento;

class Mensalidade extends Model
{
    use HasFactory;

    public function alunos()
    {
        return $this->belongsTo(Aluno::class, 'alunos_id');
    }

    public function responsaveis()
    {
        return $this->belongsTo(ResponsavelAluno::class, 'responsavel_alunos_id');
    }

    public function matriculas()
    {
        return $this->belongsTo(Matricula::class, 'matriculas_id');
    }

    public function formasPagamentos(){
        return $this->belongsTo(FormasPagamento::class, 'formas_pagamentos_id');
    }

}
