<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\MatriculaReativar;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Responsavel;

class MatriculaReativarController extends Controller
{

    const PATH = 'screens.alunos.reativar.';
    private $reativar;

    public function __construct()
    {
        $this->reativar = new MatriculaReativar();
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

        $reativar = $this->reativar;

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

            $reativar->alunos_id = $request->input('aluno');
            $reativar->matriculas_id = $request->input('matricula');
            $reativar->data = $request->input('data');
            $reativar->hora = $request->input('horario');
            $reativar->observacao = $request->input('obs');

            $reativar->save();

            $matriculaID = $request->input('matricula');

            $this->atualizarMatricula($matriculaID);

            $matricula = Matricula::find($matriculaID);

            $alunoID = $matricula->alunos_id;

            $aluno = Aluno::find($alunoID);
            $responsavel = Responsavel::where('alunos_id', $alunoID);

            return view('screens.alunos.matricula.matriculaHome')
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel)
                ->with('matricula', $matricula)
                ->with('msg', 'Matrícula reativada com sucesso! VOCÊ PRECISA ADICIONAR AS TURMAS DO ALUNO NOVAMENTE');
        } catch (\Throwable $th) {
            return 'ERRO! Não foi possivel reativar a matrícula: ' . $th->getMessage();
        }
    }

    public function show(string $id)
    {

        $matricula = Matricula::find($id);

        if (in_array($matricula->status, ['trancada', 'cancelada', 'finalizada'])) {
            return view(self::PATH . 'matriculaReativar', ['matricula' => $matricula]);
        } else {
            return back();
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

            $matricula->status = 'ativa';
            $matricula->save();
        } catch (\Throwable $th) {
            return 'ERRO! Não foi possível atualizar o status da matrícula: ' . $th->getMessage();
        }
    }
}
