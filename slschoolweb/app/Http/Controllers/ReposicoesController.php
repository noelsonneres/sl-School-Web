<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\MatriculaTurma;
use App\Models\Reposicao;
use App\Models\Turma;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class ReposicoesController extends Controller
{

    const PATH='screens.reposicao.';

    private $reposicoes;

    public function __construct()
    {
        $this->reposicoes = new Reposicao();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {

        $matricula = Matricula::find($id);
        $reposicoes = $this->reposicoes->where('matriculas_id', $id)->paginate();
        return view(self::PATH.'reposicoesShow', ['matricula'=>$matricula, 'reposicoes'=>$reposicoes]);

    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function reposicao_adicionar(string $matricula){

        $matricula = Matricula::find($matricula);
        $turmas = Turma::paginate();

        return view(self::PATH.'listarTurmasDisponiveis', ['matricula'=>$matricula, 'turmas'=>$turmas]);
    }

    public function selecionarTurma(string $matricula, string $turma){

        $matricula = Matricula::find($matricula);
        $turmas = Turma::paginate();

        if($this->verificarDuplicidade($matricula, $turma)){

            return view(self::PATH.'listarTurmasDisponiveis', ['matricula'=>$matricula, 'turmas'=>$turmas])
                            ->with('msg', 'Esta turma já adcionanda a matrícula. Escolha outra turma!');

        }else if($this->verificarDisponibilidade($turma) == true){

            return view(self::PATH.'listarTurmasDisponiveis', ['matricula'=>$matricula, 'turmas'=>$turmas])
                ->with('msg', 'Não há vagas disponíveis nesta turma. Selecione outra turma!');

        }


//        CRIAR O PROCEDIMENTO PARA ADICIONAR A REPOSIÇÃO DO ALUNO

    }

    private function verificarDisponibilidade(string $turma){

        $turmas = Turma::find($turma);
        $matriculaTurma = MatriculaTurma::where('turmas_id', $turma)->get();

        if($matriculaTurma->count() >= $turmas->sala->vagas){
            return true;
        }else{
            return false;
        };
    }

    private function verificarDuplicidade(string $matricula, string $turma){

        $matriculaTurma = MatriculaTurma::where('matriculas_id', $matricula)
            ->where('turmas_id', $turma)->get();

        return $matriculaTurma->count();

    }

}
