<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\MatriculaTurma;
use App\Models\NivelAcesso;
use App\Models\Responsavel;
use App\Models\Turma;
use Illuminate\Http\Request;

class MatriculaTurmaController extends Controller
{

    private function verificar(string $matriculaID, string $turmaID)
    {

        $turma = MatriculaTurma::where('matriculas_id', $matriculaID)->where('turmas_id', $turmaID)->get();

        if ($turma->count() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    const PATH = 'screens.alunos.turma.';
    private $turmas;

    public function __constructor()
    {
        $this->turmas = new MatriculaTurma();
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

        $turma = new MatriculaTurma();

        $request->validate(
            [
                'matricula' => 'required',
                'turma' => 'required',
            ],
            [
                'matricula.required' => 'Selecione uma matrícula antes de continuar',
                'turma.required' => 'Selecione uma turma antes de continuar',
            ]
        );

        $matriculaID = $request->input('matricula');


        $alunoID = Matricula::find($matriculaID)->alunos_id;

        $aluno = Aluno::find($alunoID)->first();
        $responsavel = Responsavel::where('alunos_id', $alunoID)->first();

        $msg = "";

        if ($this->verificar($request->input('matricula'), $request->input('turma')) == false) {

            if ($this->verificarDisponibilidade($request->input('turma')) === true) {

                try {

                    $turma->matriculas_id = $request->input('matricula');
                    $turma->alunos_id = $request->input('aluno');
                    $turma->cadastro_dias_id = $request->input('dia');
                    $turma->cadastro_horarios_id = $request->input('horario');
                    $turma->salas_id = $request->input('sala');
                    $turma->turmas_id = $request->input('turma');

                    $turma->save();

                    $msg = 'Turma adicionada na matrícula com sucesso!!!';

                } catch (\Throwable $th) {

                    $msg = 'ERRO! Não foi possível salvar as informações no banco de dados: ' . $th->getMessage();
                }
            } else {
                $msg = 'ATENÇÃO! Não há vagas disponíveis. Tente outra turma';
            }

        } else {
            $msg = 'ERRO! A turma ja está adicionada para a matrícula!';
        }


        $turma = MatriculaTurma::with('turmas')
            ->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();

        return view(self::PATH . 'matriculaTurmaShow', ['turmas' => $turma])
            ->with('aluno', $aluno)
            ->with('responsavel', $responsavel)
            ->with('matricula', $matriculaID)
            ->with('msg', $msg);
    }


    public function show(string $id)
    {
        $turma = MatriculaTurma::with('turmas')->where('matriculas_id', $id);
        return view(self::PATH . 'matriculaTurmaShow', ['turmas' => $turma]);
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

    public function listaTurmas(string $alunoID, string $matriculaID)
    {

        if ($this->verificarAcesso() == 1) {

            $aluno = Aluno::find($alunoID);
            $responsavel = Responsavel::where('alunos_id', $alunoID)->first();

            $turma = MatriculaTurma::with('turmas.dias', 'turmas.horarios')
                ->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();

            return view(self::PATH . 'matriculaTurmaShow', ['turmas' => $turma])
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel)
                ->with('matricula', $matriculaID);

        } else {
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    public function inserir(Request $request, string $matriculaID)
    {

        $listaTurmas = Turma::paginate();

        $matricula = Matricula::find($matriculaID);

        return view(self::PATH . 'matriculaTurmasCreate', ['matricula' => $matricula])
            ->with('listaTurmas', $listaTurmas);

    }

    public function remover(string $matriculaID, string $matriculaTurmaID)
    {
        $turma = MatriculaTurma::find($matriculaTurmaID);
        $msg = "";

        if ($turma->count() >= 1) {
            $turma->delete();
            $msg = "Turma removida com sucesso da matrícula!!!";
        } else {
            $msg = "ERRO! Não foi possível remover a turma da matrícula";
        }

        $alunoID = Matricula::find($matriculaID)->alunos_id;

        $aluno = Aluno::find($alunoID)->first();
        $responsavel = Responsavel::where('alunos_id', $alunoID)->first();

        $turma = MatriculaTurma::with('turmas.dias', 'turmas.horarios')
            ->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();

        return view(self::PATH . 'matriculaTurmaShow', ['turmas' => $turma])
            ->with('aluno', $aluno)
            ->with('responsavel', $responsavel)
            ->with('matricula', $matriculaID)
            ->with('msg', $msg);
    }

    private function verificarDisponibilidade(string $turma)
    {

        $matriculaTurmas = MatriculaTurma::where('turmas_id', $turma)->get();

        $total = $matriculaTurmas->count();

        $salaTurmas = Turma::with('sala')->find($turma);

        $vagasSala = $salaTurmas->sala->vagas;

        return ($total < $vagasSala) ? true : false;

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Adicionar turmas')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

}
