<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empresa;
use App\Models\Matricula;
use App\Models\Aluno;
use App\Model\ResponsavelAluno;
use App\Models\MaterialEscolar;
use App\Models\ResponsavelAluno as ModelsResponsavelAluno;

class MatriculaMaterial extends Model
{
    use HasFactory;

    public function matriculas()
    {
        return $this->belongsTo(Matricula::class, 'matriculas_id');
    }

    public function alunos()
    {
        return $this->belongsTo(Aluno::class, 'alunos_id');
    }

    public function responsaveis()
    {
        return $this->belongsTo(ModelsResponsavelAluno::class, 'responsavel_alunos_id');
    }

    public function materiais()
    {
        return $this->belongsTo(MaterialEscolar::class, 'material_escolars_id');
    }
}
