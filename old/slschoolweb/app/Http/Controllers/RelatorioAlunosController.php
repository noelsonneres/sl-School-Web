<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Empresa;
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
        $alunos = $this->aluno->where('id', 0)->orderBy('id', 'desc')->paginate();
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

        $alunos = $this->aluno->whereBetween('data_cadastro',[$dt1, $dt2])->orderBy('id', 'desc')->paginate();

        return view(self::PATH.'relAlunosShow', ['alunos'=>$alunos]);

    }

    public function localizar(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'id';
        }

        $alunos = $this->aluno::where($field, 'LIKE', $value . '%')->orderBy('id', 'desc')->paginate(15);

        return view(self::PATH.'relAlunosShow', ['alunos'=>$alunos]);

    }

    public function localizarStatus(Request $request){

        $request->validate([
            'ativo'=>'required',
        ],[
            'ativo.required'=>'Informe se você deseja buscar os alunos ativos ou bloqueados',
        ]);

        $alunos = $this->aluno->where('ativo', $request->input('ativo'))->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relAlunosShow', ['alunos'=>$alunos]);

    }

    function impressao(string $alunoID){

        $empresa = Empresa::first();

        $aluno = $this->aluno->find($alunoID);
        return view(self::PATH.'relAlunosImpressao', ['aluno'=>$aluno, 'empresa'=>$empresa]);

    }

}
