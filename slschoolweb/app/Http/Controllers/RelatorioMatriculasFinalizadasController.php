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

        $request->validate([
            'dt1' => 'required',
            'dt2' => 'required',
        ], [
            'dt1.required' => 'Infome uma data valida para o campo "Primeira data',
            'dt2.requied' => 'Infomre uma data valida pra o campo "Segunda data" ',
        ]);

        $dt1 = $request->input('dt1');
        $dt2 = $request->input('dt2');

        $finalizados = $this->finalizado->whereBetween('data', [$dt1, $dt2])->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relMatriculasFinalizadasShow', ['finalizados'=>$finalizados]);       

    }        

    public function localizar(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'matriculas_id';
        }

        $finalizados = $this->finalizado::where($field, 'LIKE', $value . '%')->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relMatriculasFinalizadasShow', ['finalizados'=>$finalizados]);   

    }

    public function impressao(String $id){
        $empresa = Empresa::first();
        $finalizado = $this->finalizado->find($id);
        return view(self::PATH.'relMatriculasFinalizadasImpressao', ['finalizado'=>$finalizado, 'empresa'=>$empresa]);
    }

}
