<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Matricula;
use App\Models\MatriculaDisciplina;
use App\Models\NivelAcesso;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class MatriculaDisciplinasController extends Controller
{

    const PATH = 'screens.alunos.disciplina.';
    private $disciplina;

    public function __construct()
    {
        $this->disciplina = new MatriculaDisciplina();
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

        $disciplina = $this->disciplina;


        $request->validate(
            [
                'disciplina' => 'required',
            ],
            [
                'disciplina.required' => 'Selecione a disciplina que deseja incluir!',
            ]
        );

        $inicio = $request->old('inicio');
        $termino = $request->old('termino');
        $concluido = $request->old('concluido');

        $matriculaID = $request->input('matricula');

        try {

            $disciplina->alunos_id = $request->input('aluno');
            $disciplina->matriculas_id = $request->input('matricula');
            $disciplina->cursos_id = $request->input('curso');
            $disciplina->disciplinas_id = $request->input('disciplina');
            $disciplina->inicio = $request->input('inicio');
            $disciplina->termino = $request->input('termino');
            $disciplina->concluido = $request->input('concluido');
            $disciplina->obs = $request->input('obs');

            $disciplina->save();

            $matDisc = $this->disciplina
                ->with('disciplinas')
                ->with('cursos')
                ->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();

            $matricula = Matricula::with('alunos')->find($matriculaID);

            // dd($matricula);

            return view(self::PATH . 'disciplinasShow', ['disciplinas' => $matDisc, 'matricula' => $matricula])
                ->with('msg', 'Disciplina incluida com sucesso!!!');
        } catch (\Throwable $th) {
            return 'ERRO! Não foi possível inseir as informações da matrícula! : ' . $th->getMessage();
        }
    }

    public function show(string $id)
    {

        if ($this->verificarAcesso() == 1) {

            $matDisc = $this->disciplina
                ->with('disciplinas')
                ->with('cursos')
                ->where('matriculas_id', $id)->orderBy('id', 'desc')->paginate();

            $matricula = Matricula::with('alunos')->find($id);

            return view(self::PATH . 'disciplinasShow', ['disciplinas' => $matDisc, 'matricula' => $matricula]);
        } else {
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }
    }

    public function edit(string $id)
    {

        if ($this->verificarAcesso() == 1) {

            $disciplina = $this->disciplina->find($id);
            $matriculaID = $disciplina->matriculas_id;

            $matricula = Matricula::with('alunos')->find($matriculaID);

            return view(self::PATH . 'disciplinasEdit', ['disciplina' => $disciplina, 'matricula' => $matricula]);
        } else {
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }
    }

    public function update(Request $request, string $id)
    {

        $disciplina = $this->disciplina->find($id);

        $matriculaID = $disciplina->matriculas_id;

        if ($disciplina->count() >= 1) {

            $request->validate(
                [
                    'inicio' => 'required',
                    //                'termino' => 'required',
                    'concluido' => 'required',
                ],
                [
                    'inicio.required' => 'Informe uma data valida para o campo Início',
                    //            'termino.required'=>'Informe uma data valida para o campo Término',
                    'concluido.required' => 'Selecione um valor para o campo Situaçào',
                ]
            );

            $inicio = $request->old('inicio');
            $termino = $request->old('termino');
            $concluido = $request->old('concluido');

            try {

                $disciplina->inicio = $request->input('inicio');
                $disciplina->termino = $request->input('termino');
                $disciplina->concluido = $request->input('concluido');
                $disciplina->obs = $request->input('obs');

                $disciplina->save();

                $matDisc = $this->disciplina
                    ->with('disciplinas')
                    ->with('cursos')
                    ->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();

                $matricula = Matricula::with('alunos')->find($matriculaID);

                return view(self::PATH . 'disciplinasShow', ['disciplinas' => $matDisc, 'matricula' => $matricula])
                    ->with('msg', 'Informações sobre a disciplinas foram atualizadas com sucesso!!!');
            } catch (\Throwable $th) {
                return 'ERRO! Não foi possível atualizar as informações do aluno! : ' . $th->getMessage();
            }
        }
    }

    public function destroy(string $id)
    {

        if ($this->verificarAcesso() == 1) {

            $disciplina = $this->disciplina->find($id);

            // dd($disciplina);

            if ($disciplina->count() >= 1) {

                $matriculaID = $disciplina->matriculas_id;

                try {

                    $disciplina->delete();

                    $matDisc = $this->disciplina
                        ->with('disciplinas')
                        ->with('cursos')
                        ->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();

                    $matricula = Matricula::with('alunos')->find($matriculaID);

                    return view(self::PATH . 'disciplinasShow', ['disciplinas' => $matDisc, 'matricula' => $matricula])
                        ->with('msg', 'Informações sobre a disciplinas foram atualizadas com sucesso!!!');
                } catch (\Throwable $th) {
                    return 'ERRO! Não foi possível atualizar as informações do aluno! : ' . $th->getMessage();
                }
            } else {
                return redirect()->back();
            }
        } else {
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }
    }

    public function adicionar(string $matriculaID)
    {

        if ($this->verificarAcesso() == 1) {

            if (isset($matriculaID)) {

                $listaDisciplinas = Disciplina::all();

                $matricula = Matricula::with('alunos')->find($matriculaID);

                return view(self::PATH . 'disciplinasCreate', ['matricula' => $matricula, 'listaDisciplinas' => $listaDisciplinas]);
            } else {
                return redirect()->back();
            }
        } else {
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }
        
    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Adicionar disciplinas')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }
}
