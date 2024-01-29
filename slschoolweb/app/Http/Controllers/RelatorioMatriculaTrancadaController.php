<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
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

    public function impressao(String $id){
        $trancado = $this->trancado->find($id);
        $empresa = Empresa::first();
        return view(self::PATH.'relMatriculaTrancadasImpressao', ['trancado'=>$trancado, 'empresa'=>$empresa]);
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

        $trancado = $this->trancado->whereBetween('data', [$dt1, $dt2])->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relMatriculaTrancadaShow', ['trancados'=>$trancado]);          

    }

    public function localizar(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'matriculas_id';
        }

        $trancado = $this->trancado::where($field, 'LIKE', $value . '%')->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relMatriculaTrancadaShow', ['trancados'=>$trancado]);            

    }

}
