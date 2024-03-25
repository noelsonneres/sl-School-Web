<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculasContratosController extends Controller
{
    const PATH = 'screens.matricula.contrato.';
    private $contratos;

    public function __construct()
    {
        $this->contratos = new Contrato();
    }

    public function index(string $matriculaID)
    {
        $contrato = $this->contratos->where('empresas_id', auth()->user()->empresas_id)
                                ->where('deletado', 'nao')
                                ->paginate();
        $matricula = Matricula::find($matriculaID);
        return view(self::PATH.'contratosLista', ['contratos'=>$contrato, 'matricula'=>$matricula]);
    }

    public function gerarContrato(string $matriculaID, string $contratoID)
    {
       
        $turmas = $this->retornarTurmas($matriculaID);
        $contato = $this->retornarContrato($contratoID);

    }


    // Metodos private
    private function retornarContrato(string $contratoID){

    }

    private function retornarTurmas(string $matricula)
    {

    }

}
