<?php

namespace App\Http\Controllers;

use App\Models\MatriculaCancelamento;
use Illuminate\Http\Request;

class RelatorioMatriculaCancelamentoController extends Controller
{
    
    const PAHT = 'screens.relatorios.cancelado.';   
    private $cancelado;

    public function __construct(){
        $this->cancelado = new MatriculaCancelamento();
    }

    public function index(){
        $cancelado = $this->cancelado->orderBy('id', 'desc')->paginate();
        return view(self::PAHT.'relMatriculaCanceladaShow', ['cancelados'=>$cancelado]);
    }

    public function localizar(Request $request){

    }

}
