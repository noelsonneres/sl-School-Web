<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Disciplina;

class CursosDisciplina extends Model
{
    use HasFactory;

    public function disciplinas(){
        return $this->belongsTo(Disciplina::class, 'disciplinas_id');
    }

}
