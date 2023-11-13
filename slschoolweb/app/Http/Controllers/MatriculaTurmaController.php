<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\MatriculaTurma;
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

            try {

                $turma->matriculas_id = $request->input('matricula');
                $turma->turmas_id = $request->input('turma');

                $turma->save();

                $msg = 'Turma adicionada na matrícula com sucesso!!!';

            } catch (\Throwable $th) {

                $msg = 'ERRO! Não foi possível salvar as informações no banco de dados!';
                
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

        $aluno = Aluno::find($alunoID);
        $responsavel = Responsavel::where('alunos_id', $alunoID)->first();

        $turma = MatriculaTurma::with('turmas.dias', 'turmas.horarios')
            ->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();

        return view(self::PATH . 'matriculaTurmaShow', ['turmas' => $turma])
            ->with('aluno', $aluno)
            ->with('responsavel', $responsavel)
            ->with('matricula', $matriculaID);
    }

    public function inserir(Request $request, string $matriculaID)
    {

        $listaTurmas = Turma::paginate();

        return view(self::PATH . 'matriculaTurmasCreate', ['matricula' => $matriculaID])
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
}
