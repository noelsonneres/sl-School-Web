<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\MatriculaTurma;
use App\Models\Reposicao;
use App\Models\Turma;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReposicoesController extends Controller
{

    const PATH = 'screens.reposicao.';

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
        $reposicoes = $this->reposicoes->where('matriculas_id', $id)->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'reposicoesShow', ['matricula' => $matricula, 'reposicoes' => $reposicoes]);

    }

    public function edit(string $id)
    {

        $reposicao = $this->reposicoes->find($id);

        $matriculaID = $reposicao->matriculas_id;

        $matricula = Matricula::find($matriculaID);

        if ($reposicao->status != 'marcada') {

            $reposicoes = $this->reposicoes->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();
            return view(self::PATH . 'reposicoesShow', ['matricula' => $matricula, 'reposicoes' => $reposicoes])
                ->with('msg', 'Não é possivel editar os dados desta resposição!');

        } else {
            return view(self::PATH . 'reposicaoEdit', ['matricula'=>$matricula, 'reposicao'=>$reposicao]);
        }

    }

    public function update(Request $request, string $id)
    {

        $reposicao = $this->reposicoes->find($id);

        $request->validate([
            'turma' => 'required',
            'dataMarcacao' => 'required',
            'horaMarcacao' => 'required',
            'dataReposicao' => 'required',
            'horaReposicao' => 'required',
            'status' => 'required',
        ]);

        try {

            $matriculaID = $request->input('matricula');
            $turma = $request->input('turma');

            $reposicao->alunos_id = $request->input('aluno');
            $reposicao->matriculas_id = $request->input('matricula');
            $reposicao->turmas_id = $request->input('turma');
            $reposicao->data_marcacao = $request->input('dataMarcacao');
            $reposicao->hora_marcacao = $request->input('horaMarcacao');
            $reposicao->data_reposicao = $request->input('dataReposicao');
            $reposicao->hora_reposicao = $request->input('horaReposicao');
            $reposicao->status = $request->input('status');
            $reposicao->obsrvacao = $request->input('obs');

            $reposicao->save();

            $matricula = Matricula::find($matriculaID);
            $reposicoes = $this->reposicoes->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();
            return view(self::PATH . 'reposicoesShow', ['matricula' => $matricula, 'reposicoes' => $reposicoes])
                    ->with('msg', 'As informações da reposição foram atualizadas com sucesso!');

        } catch (\Throwable $th) {
            $matricula = Matricula::find($matriculaID);
            $turmaSelecionada = Turma::find($turma);
            return view(self::PATH . 'reposicaoCreate', ['matricula' => $matricula, 'turmas' => $turmaSelecionada])
                ->with('msg', 'Não foi possível marcar a reposição. Verifque os campos e tente novamente!');

        }

    }

    public function destroy(string $id)
    {

        $reposicao = $this->reposicoes->find($id);
        $matriculaID = $reposicao->matriculas_id;

        $msg = '';

        if($reposicao->count() >= 1){

            try {
                $reposicao->delete();

                $msg = 'A reposição foi deletada com sucesso!';
            }catch (\Throwable $th){
                $msg = 'Não foi possível  excluir a reposição: '.$th->getMessage();
            }

        }else{

            $msg = 'Não foi possível  excluir a reposição';

        }

        $matricula = Matricula::find($matriculaID);
        $reposicoes = $this->reposicoes->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'reposicoesShow', ['matricula' => $matricula, 'reposicoes' => $reposicoes])
            ->with('msg', $msg);

    }

    public function reposicao_adicionar(string $matricula)
    {

        $matricula = Matricula::find($matricula);
        $turmas = Turma::paginate();

        return view(self::PATH . 'listarTurmasDisponiveis', ['matricula' => $matricula, 'turmas' => $turmas]);
    }

    public function selecionarTurma(string $matriculaID, string $turma)
    {

        $matricula = Matricula::find($matriculaID);
        $turmas = Turma::paginate();
        $msg = '';

        if ($this->verificarDuplicidade($matriculaID, $turma) >= 1) {

            $msg = 'Esta turma já adcionanda a matrícula. Escolha outra turma!';

        } else if ($this->verificarDisponibilidade($turma) == true) {

            $msg = 'Não há vagas disponíveis nesta turma. Selecione outra turma!';

        } else if ($this->verificarReposicao($matriculaID, $turma) == true) {

            $msg = 'Já existe uma reposição agendada para este aluno na turma selecionda.
                            Selecione outra turma ou finalize a reposição!';

        } else {
            $turmaSelecionada = Turma::find($turma);
            return view(self::PATH . 'reposicaoCreate', ['matricula' => $matricula, 'turmas' => $turmaSelecionada]);
        }

        return view(self::PATH . 'listarTurmasDisponiveis', ['matricula' => $matricula, 'turmas' => $turmas])
            ->with('msg', $msg);

    }

    public function marcarReposicao(Request $request)
    {

        $reposicao = $this->reposicoes;

        $request->validate([
            'turma' => 'required',
            'dataMarcacao' => 'required',
            'horaMarcacao' => 'required',
            'dataReposicao' => 'required',
            'horaReposicao' => 'required',
            'status' => 'required',
        ]);

        try {

            $matriculaID = $request->input('matricula');
            $turma = $request->input('turma');

            $reposicao->alunos_id = $request->input('aluno');
            $reposicao->matriculas_id = $request->input('matricula');
            $reposicao->turmas_id = $request->input('turma');
            $reposicao->data_marcacao = $request->input('dataMarcacao');
            $reposicao->hora_marcacao = $request->input('horaMarcacao');
            $reposicao->data_reposicao = $request->input('dataReposicao');
            $reposicao->hora_reposicao = $request->input('horaReposicao');
            $reposicao->status = $request->input('status');
            $reposicao->obsrvacao = $request->input('obs');

            $reposicao->save();

            $matricula = Matricula::find($matriculaID);
            $reposicoes = $this->reposicoes->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();
            return view(self::PATH . 'reposicoesShow', ['matricula' => $matricula, 'reposicoes' => $reposicoes])
                    ->with('msg', 'Reposição agendada com sucesso!');

        } catch (\Throwable $th) {
            $matricula = Matricula::find($matriculaID);
            $turmaSelecionada = Turma::find($turma);
            return view(self::PATH . 'reposicaoCreate', ['matricula' => $matricula, 'turmas' => $turmaSelecionada])
                ->with('msg', 'Não foi possível marcar a reposição. Verifque os campos e tente novamente!');

        }
    }

    public function localizar(Request $request){

        $inicio = Carbon::parse($request->input('inicio'));
        $fim = Carbon::parse($request->input('fim'));
        $matriculaID = $request->input('matricula');

        $reposicoes = $this->reposicoes->whereBetween('data_reposicao', [$inicio, $fim])
            ->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();

        $matricula = Matricula::find($matriculaID);

        return view(self::PATH . 'reposicoesShow', ['matricula' => $matricula, 'reposicoes' => $reposicoes])
            ->with('msg', 'Reposição agendada com sucesso!');

    }

    private function verificarDisponibilidade(string $turma)
    {

        $turmas = Turma::find($turma);
        $matriculaTurma = MatriculaTurma::where('turmas_id', $turma)->get();

        if ($matriculaTurma->count() >= $turmas->sala->vagas) {
            return true;
        } else {
            return false;
        }
    }

    private function verificarDuplicidade(string $matricula, string $turma)
    {

        $matriculaTurma = MatriculaTurma::where('matriculas_id', $matricula)
            ->where('turmas_id', $turma)->get();

        return $matriculaTurma->count();

    }

    private function verificarReposicao(string $matriculaID, string $turmaID)
    {

        $reposicao = Reposicao::where('matriculas_id', $matriculaID)
            ->where('turmas_id', $turmaID)
            ->where('status', 'marcada')
            ->get();

        if ($reposicao->count() >= 1) {
            return true;
        } else {
            return false;
        }

    }

}
