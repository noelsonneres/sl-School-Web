<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\MatriculaTrancamento;
use App\Models\MotivoCancelamento;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\MatriculaTurma;
use App\Models\Responsavel;

class MatriculaTrancamentoController extends Controller
{

    const PATH = 'screens.alunos.trancar.';
    private $trancar;

    public function __construct()
    {
        $this->trancar = new MatriculaTrancamento();
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

        $trancar = $this->trancar;

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

            $trancar->alunos_id = $request->input('aluno');
            $trancar->matriculas_id = $request->input('matricula');
            $trancar->data = $request->input('data');
            $trancar->hora = $request->input('horario');
            $trancar->motivo = $request->input('motivo');
            $trancar->observacao = $request->input('obs');

            $trancar->save();

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

        $trancar = $this->trancar->where('matriculas_id', $id);
        $matricula = Matricula::find($id);

        if (in_array($matricula->status, ['trancada', 'cancelada', 'finalizada'])) {

            $alunoID = $matricula->alunos_id;

            $aluno = Aluno::find($alunoID);
            $responsavel = Responsavel::where('alunos_id', $alunoID);

            return view('screens.alunos.matricula.matriculaHome')
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel)
                ->with('matricula', $matricula)
                ->with('msg', 'Esta matrícula se encontra trancada!');
        } else {

            $listaMotivos = MotivoCancelamento::all();

            return view(self::PATH . 'trancarMatricula', ['matricula' => $matricula, 'listaMotivos' => $listaMotivos]);
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

            $matricula->status = 'trancada';
            $matricula->save();
        } catch (\Throwable $th) {
            return 'ERRO! Não foi possível atualizar o status da matrícula: ' . $th->getMessage();
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
}
