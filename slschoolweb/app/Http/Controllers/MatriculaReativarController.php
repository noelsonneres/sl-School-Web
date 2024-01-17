<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\MatriculaReativar;
use App\Models\Mensalidade;
use App\Models\NivelAcesso;
use App\Models\Responsavel;
use Illuminate\Http\Request;

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
        $matriculas = Matricula::orderBy('id', 'desc')->where('status', '!=', 'ativa')->paginate();
        return view(self::PATH.'localizarMatricula', ['matriculas'=>$matriculas]);
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

            $this->reativarMensalidades($matriculaID);

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

        if ($this->verificarAcesso() == 1) {

            $matricula = Matricula::find($id);

            if (in_array($matricula->status, ['trancada', 'cancelada', 'finalizada'])) {
                return view(self::PATH . 'matriculaReativar', ['matricula' => $matricula]);
            } else {
                return redirect()->back()->with('msg', 'Esta matrícula não esta mais ativa!');
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

            $matricula->status = 'ativa';
            $matricula->save();
        } catch (\Throwable $th) {
            return 'ERRO! Não foi possível atualizar o status da matrícula: ' . $th->getMessage();
        }
    }

    public function selecionarMatricula(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'id';
        }

        // $matriculas = Matricula::where($field, 'LIKE', $value . '%', 'status', '!=', 'ativa')->orderBy('id', 'desc')->paginate(15);
        $matriculas = Matricula::where($field, 'LIKE', $value . '%')
        ->where('status', '!=', 'ativa')
        ->orderBy('id', 'desc')
        ->paginate(15);
    
        return view(self::PATH.'localizarMatricula', ['matriculas'=>$matriculas]);

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Reativar matricula')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    private function reativarMensalidades(string $matriculaID)
    {

        $mensalidades = Mensalidade::where('matriculas_id', $matriculaID)->get();

        if ($mensalidades != null) {

            foreach ($mensalidades as $mensalidade) {

                if ($mensalidade->pago == 'cancelado') {
                    $mensalidade->pago = 'nao';
                    $mensalidade->save();
                }
            }
        };
    }      

}
