<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\MatriculaFinalizar;
use Illuminate\Http\Request;

class RelatorioMatriculasFinalizadasController extends Controller
{
    
    const PATH = 'screens.relatorios.finalizado.';
    private $finalizado;

    public function __construct()
    {
        $this->finalizado = new MatriculaFinalizar();
    }

    public function index(){
        $finalizados = $this->finalizado->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relMatriculasFinalizadasShow', ['finalizados'=>$finalizados]);
    }

    public function localizarEntreDatas(Request $request){

    }

    public function localizar(Request $request){

    }

    public function impressao(String $id){
        $empresa = Empresa::first();
        $finalizado = $this->finalizado->find($id);
        return view(self::PATH.'relMatriculasFinalizadasImpressao', ['finalizado'=>$finalizado, 'empresa'=>$empresa]);
    }

}
