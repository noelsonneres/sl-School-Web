<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class RelatorioAlunosController extends Controller
{
    
    const PATH = 'screens.relatorios.aluno.';
    private $aluno;

    public function __construct()
    {
        $this->aluno = new Aluno();
    }

    public function index(){
        $alunos = $this->aluno->where('id', 0)->paginate();
        return view(self::PATH.'relAlunosShow', ['alunos'=>$alunos]);
    }

    public function localizarEntreDatas(Request $request){

        $request->validate([
            'dt1'=>'required',
            'dt2'=>'required',
        ],[
            'dt1.required'=>'Selecione a data de início da pesquisa',
            'dt2.required'=>'Selecione a data final para a pesquisa',
        ]);

        $dt1 = $request->input('dt1');
        $dt2 = $request->input('dt2');

        $alunos = $this->aluno->whereBetween('data_cadastro',[$dt1, $dt2])->paginate();

        return view(self::PATH.'relAlunosShow', ['alunos'=>$alunos]);

    }

    public function localizar(Request $request){

    }

    public function localizarStatus(Request $request){

    }

}
