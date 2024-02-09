<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\MatriculaTrancamento;
use App\Models\MotivoCancelamento;
use App\Models\NivelAcesso;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\MatriculaTurma;
use App\Models\Mensalidade;
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
        $matriculas = Matricula::orderBy('id', 'desc')->where('status', 'ativa')->paginate();
        return view(self::PATH.'localizarMatricula', ['matriculas'=>$matriculas]);
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
            $this->cancelarMensalidades($matriculaID);

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

        if($this->verificarAcesso() == 1){

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

        }else{
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

    public function selecionarMatricula(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'id';
        }

        $matriculas = Matricula::where($field, 'LIKE', $value . '%')->where('status', 'ativa')->orderBy('id', 'desc')->paginate(15);
        return view(self::PATH.'localizarMatricula', ['matriculas'=>$matriculas]);

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Trancar matricula')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    private function cancelarMensalidades(string $matriculaID)
    {

        $mensalidades = Mensalidade::where('matriculas_id', $matriculaID)->get();

        if ($mensalidades != null) {

            foreach ($mensalidades as $mensalidade) {

                if ($mensalidade->pago == 'nao') {
                    $mensalidade->pago = 'cancelado';
                    $mensalidade->save();
                }
            }
        };
    }    

}
