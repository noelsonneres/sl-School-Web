<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Reposicao;
use App\Models\Turma;
use Illuminate\Http\Request;

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
        $turmas = Turma::all();

        // Exibir a lista de turmas e o total de vagas por turma
        // Verificar se esta turma já esta cheia
        // Verificar se o aluno não esta matrículado nesta turma

        return view(self::PATH.'listarTurmasDisponiveis', ['matricula'=>$matricula, 'turmas'=>$turmas]);
    }

}
