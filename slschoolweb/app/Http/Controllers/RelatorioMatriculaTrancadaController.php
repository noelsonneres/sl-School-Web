<?php

namespace App\Http\Controllers;

use App\Models\MatriculaTrancamento;
use Illuminate\Http\Request;

class RelatorioMatriculaTrancadaController extends Controller
{

    const PATH = 'screens.relatorios.trancada.';
    private $trancado;

    public function __construct()
    {
        $this->trancado = new MatriculaTrancamento();
    }

    public function index(){
        $trancado = $this->trancado->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relMatriculaTrancadaShow', ['trancados'=>$trancado]);
    }

    public function localizarEntreDatas(Request $request){

    }

    public function localizar(){

    }

}
