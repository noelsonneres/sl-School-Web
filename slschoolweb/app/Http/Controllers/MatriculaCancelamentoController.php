<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\MatriculaCancelamento;
use App\Models\MotivoCancelamento;
use App\Models\NivelAcesso;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\MatriculaTurma;
use App\Models\Responsavel;

class MatriculaCancelamentoController extends Controller
{

    const PATH = 'screens.alunos.cancelar.';
    private $cancelar;

    public function __construct()
    {
        $this->cancelar = new MatriculaCancelamento();
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

        $cancelar = $this->cancelar;

        $request->validate([
            'data' => 'required',
            'horario' => 'required',
            'motivo' => 'required',
        ], [
            'data.required' => 'Informe uma data de cancelamento',
            'horario.required' => 'Informe um horário para o cancelamento',
            'motivo.required' => 'Selecione o motívo para o cancelamento',
        ]);

        $data = $request->old('data');
        $horario = $request->old('horario');
        $motivo = $request->old('motivo');

        try {

            $cancelar->alunos_id = $request->input('aluno');
            $cancelar->matriculas_id = $request->input('matricula');
            $cancelar->data = $request->input('data');
            $cancelar->hora = $request->input('horario');
            $cancelar->motivo = $request->input('motivo');
            $cancelar->observacao = $request->input('obs');

            $cancelar->save();

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
                ->with('matricula', $matricula);
        } catch (\Throwable $th) {
            return 'ERRO! Não foi possivel cancelar a matrícula: ' . $th->getMessage();
        }
    }

    public function show(string $id)
    {
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

    public function cancelarMatricula(string $matricula)
    {

        if($this->verificarAcesso() == 1){

            $cancelar = $this->cancelar->where('matriculas_id', $matricula);
            $matricula = Matricula::find($matricula);

            if (in_array($matricula->status, ['trancada', 'cancelada', 'finalizada'])) {

                $alunoID = $matricula->alunos_id;

                $aluno = Aluno::find($alunoID);
                $responsavel = Responsavel::where('alunos_id', $alunoID);

                return view('screens.alunos.matricula.matriculaHome')
                    ->with('aluno', $aluno)
                    ->with('responsavel', $responsavel)
                    ->with('matricula', $matricula)
                    ->with('msg', 'Esta matrícula já esta cancelada!');
            } else {

                $listaMotivos = MotivoCancelamento::all();
                return view(self::PATH . 'cancelarMatricula', ['matricula' => $matricula, 'listaMotivos' => $listaMotivos]);
            }

        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    private function atualizarMatricula(string $mat)
    {

        try {

            $matricula = Matricula::find($mat);

            $matricula->status = 'cancelada';
            $matricula->save();
        } catch (\Throwable $th) {
            return 'ERRO! Não foi possível atualizar o status da matrícula: ' . $th->getMessage();
        }
    }

    private function removerTurmas(string $matricula){

        $turmas = MatriculaTurma::where('matriculas_id', $matricula);

        try {
            $turmas->delete();
        } catch (\Throwable $th) {
            return 'ERRO! Não foi possível excluir as turmas dos alunos: '.$th;
        }

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Cancelar matricula')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

}
