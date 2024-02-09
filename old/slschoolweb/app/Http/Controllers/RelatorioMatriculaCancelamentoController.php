<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\MatriculaCancelamento;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class RelatorioMatriculaCancelamentoController extends Controller
{
    
    const PATH = 'screens.relatorios.cancelado.';   
    private $cancelado;

    public function __construct(){
        $this->cancelado = new MatriculaCancelamento();
    }

    public function index(){
        $cancelado = $this->cancelado->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relMatriculaCanceladaShow', ['cancelados'=>$cancelado]);
    }

    public function impressao(String $id){

        $cancelado = $this->cancelado->find($id);
        $empresa = Empresa::first();
        return view(self::PATH.'relMatriculaCanceladosImpressao', ['cancelado'=>$cancelado, 'empresa'=>$empresa]);
    }

    public function localizar(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'matriculas_id';
        }

        $cancelado = $this->cancelado::where($field, 'LIKE', $value . '%')->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relMatriculaCanceladaShow', ['cancelados'=>$cancelado]);         

    }
    
    public function localizarData(Request $request){

        $request->validate([
            'dt1' => 'required',
            'dt2' => 'required',
        ], [
            'dt1.required' => 'Infome uma data valida para o campo "Primeira data',
            'dt2.requied' => 'Infomre uma data valida pra o campo "Segunda data" ',
        ]);

        $dt1 = $request->input('dt1');
        $dt2 = $request->input('dt2');

        $cancelado = $this->cancelado->whereBetween('data', [$dt1, $dt2])->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relMatriculaCanceladaShow', ['cancelados'=>$cancelado]);       

    }

}
