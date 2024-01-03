<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\MatriculaFinalizar;
use App\Models\NivelAcesso;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\MatriculaTurma;
use App\Models\Responsavel;


class MatriculaFinalizarController extends Controller
{

    const PATH = 'screens.alunos.finalizar.';
    private $finalizar;

    public function __construct()
    {
        $this->finalizar = new MatriculaFinalizar();
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

        $finalizar = $this->finalizar;

        $request->validate([
            'data' => 'required',
            'horario' => 'required',
        ], [
            'data.required' => 'Informe uma data de cancelamento',
            'horario.required' => 'Informe um horário para o cancelamento',
        ]);

        $data = $request->old('data');
        $horario = $request->old('horario');
        $motivo = $request->old('motivo');

        try {

            $finalizar->alunos_id = $request->input('aluno');
            $finalizar->matriculas_id = $request->input('matricula');
            $finalizar->data = $request->input('data');
            $finalizar->hora = $request->input('horario');
            $finalizar->observacao = $request->input('obs');

            $finalizar->save();

            $matriculaID = $request->input('matricula');

            $this->atualizarMatricula($matriculaID);
            $this->removerTurmas($matriculaID);

            $matricula = Matricula::find($matriculaID);

            $alunoID = $matricula->alunos_id;

            $aluno = Aluno::find($alunoID);
            $responsavel = Responsavel::where('alunos_id', $alunoID);

            return view('screens.alunos.matricula.matriculaHome')
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel)
                ->with('matricula', $matricula)
                ->with('msg', 'Matrícula finalizada com sucesso!!!');
        } catch (\Throwable $th) {
            return 'ERRO! Não foi possivel finalizar a matrícula: ' . $th->getMessage();
        }
    }

    public function show(string $id)
    {

        if ($this->verificarAcesso() == 1) {

            $finalizar = $this->finalizar->where('matriculas_id', $id);
            $matricula = Matricula::find($id);

            if (in_array($matricula->status, ['trancada', 'cancelada', 'finalizada'])) {

                $alunoID = $matricula->alunos_id;

                $aluno = Aluno::find($alunoID);
                $responsavel = Responsavel::where('alunos_id', $alunoID);

                return view('screens.alunos.matricula.matriculaHome')
                    ->with('aluno', $aluno)
                    ->with('responsavel', $responsavel)
                    ->with('matricula', $matricula)
                    ->with('msg', 'ATENÇÃO! A matrícula não esta ativa!');
            } else {

                return view(self::PATH . 'finalizarMatricula', ['matricula' => $matricula]);
            }

        } else {
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

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

    private function atualizarMatricula(string $mat)
    {

        try {

            $matricula = Matricula::find($mat);

            $matricula->status = 'finalizada';
            $matricula->save();
        } catch (\Throwable $th) {
            return 'ERRO! Não foi possível finalizaar a matrícula: ' . $th->getMessage();
        }
    }

    private function removerTurmas(string $matricula)
    {

        $turmas = MatriculaTurma::where('matriculas_id', $matricula);

        try {
            $turmas->delete();
        } catch (\Throwable $th) {
            return 'ERRO! Não foi possível excluir as turmas dos alunos: ' . $th;
        }

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Finalizar matricula')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

}
