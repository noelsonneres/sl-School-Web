<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Responsavel;
use Illuminate\Http\Request;

class RelatorioResponsaveisController extends Controller
{
    
    const PATH = 'screens.relatorios.responsavel.';
    private $responsavel;

    public function __construct()
    {
        $this->responsavel = new Responsavel();
    }

    public function index(){

    }

    public function localizarPorAluno(string $alunoID){
        $responsavel = $this->responsavel->where('alunos_id', $alunoID)->first();
        $empresa = Empresa::first();
        return view(self::PATH.'relResponsavelImpressao', ['responsavel'=>$responsavel, 'empresa'=>$empresa]);
    }

    public function localizar(string $responsavelID){

    }

}
