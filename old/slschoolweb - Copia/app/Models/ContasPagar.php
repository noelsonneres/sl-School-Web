<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PlanoContas;

class ContasPagar extends Model
{
    use HasFactory;

    public function planoContas(){
        return $this->belongsTo(PlanoContas::class, 'plano_contas_id');
    }
}
