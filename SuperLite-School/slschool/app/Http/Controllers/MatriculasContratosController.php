<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;

class MatriculasContratosController extends Controller
{
    const PATH = 'screens.matricula.contrato.';
    private $contratos;

    public function __construct()
    {
        $this->contratos = new Contrato();
    }

    public function index(string $matricula)
    {
        $contrato = $this->contratos->where('empresas_id', auth()->user()->empresas_id)
                                ->where('deletado', 'nao')
                                ->paginate();
        return view(self::PATH.'contratosLista', ['contratos'=>$contrato, 'matricula'=>$matricula]);
    }

}
