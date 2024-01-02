<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\NivelAcesso;
use Illuminate\Http\Request;

class HomeAlunosController extends Controller
{

    const PATH = 'screens.alunos.';

    private $alunos;

    public function __construct()
    {
        $this->alunos = new Aluno();
    }

    public function homeAlunos(){

        if($this->verificarAcesso() == 1){
            $alunos = $this->alunos->orderBy('id', 'desc')->paginate();
            return view(self::PATH.'homeShow', ['alunos'=>$alunos]);
        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    public function find(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if(empty($field)){
            $field = 'id';
        }

        $alunos = Aluno::where($field, 'LIKE', $value.'%')->paginate(15);
        return view(self::PATH.'homeShow', ['alunos'=>$alunos]);

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Cadastro de alunos')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

}
