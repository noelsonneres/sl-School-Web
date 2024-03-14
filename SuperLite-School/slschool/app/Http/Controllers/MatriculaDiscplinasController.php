<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Matricula;
use App\Models\MatriculaDisciplina;
use Illuminate\Http\Request;

class MatriculaDiscplinasController extends Controller
{

    const PATH = 'screens.matricula.disciplina.';
    private $disciplinas;

    public function __construct()
    {
        $this->disciplinas = new MatriculaDisciplina();
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

        $disciplina = $this->disciplinas;

        $request->validate([
            'aluno' => 'required',
            'matricula' => 'required',
            'disciplina' => 'required',
        ], [
            'aluno.required' => 'Selecione uma aluno',
            'matricula.required' => 'Selecione uma matrícula',
            'disciplina.required' => 'Selecione uma disciplina para inclusão',
        ]);

        $matriculaID = $request->input('matricula');
        $disciplinaID = $request->input('disciplina');

        if ($this->veirificarDisciplina($matriculaID, $disciplinaID) == false) {

            try {

                $disciplina->empresas_id = auth()->user()->empresas_id;
                $disciplina->matriculas_id = $request->input('matricula');
                $disciplina->alunos_id = $request->input('aluno');
                $disciplina->disciplinas_id = $request->input('disciplina');
                $disciplina->concluido = 'nao';

                $disciplina->save();

                $disciplinas = $this->disciplinas->where('matriculas_id', $matriculaID)->orderBy('id', 'desc')->paginate();
                $matricula = Matricula::find($matriculaID);

                $listaDisciplinas = Disciplina::where('empresas_id', auth()->user()->empresas_id)
                    ->where('deletado', 'nao')->get();

                return view(self::PATH . 'disciplinaShow', [
                    'disciplinas' => $disciplinas,
                    'matricula' => $matricula,
                    'listaDisciplinas' => $listaDisciplinas
                ])->with('msg', 'Sucesso! Disciplina incluida com sucesso!');
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível inseir a disciplina selecionada: ' . $th->getMessage()]);
            }
        }else{
            return redirect()->back()->withInput()->withErrors(['ATENÇÃO! Está disciplina já esta incluida na matrícula do aluno!']);
        }
    }

    public function show(string $id)
    {
        $disciplinas = $this->disciplinas->where('matriculas_id', $id)->orderBy('id', 'desc')->paginate();
        $matricula = Matricula::find($id);

        $listaDisciplinas = Disciplina::where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')->get();

        return view(self::PATH . 'disciplinaShow', [
            'disciplinas' => $disciplinas,
            'matricula' => $matricula,
            'listaDisciplinas' => $listaDisciplinas
        ]);
    }

    public function edit(string $id)
    {
        $disciplina = $this->disciplinas->find($id);
        return view(self::PATH.'disciplinaEdit', ['disciplina'=>$disciplina]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function novaDisciplina(string $matriculaID, string $aluno)
    {
        $listaDisciplinas = Disciplina::where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->paginate();
        return view(self::PATH . 'disciplinasCreate', [
            'listaDisciplinas' => $listaDisciplinas,
            'matriculaID' => $matriculaID,
            'aluno' => $aluno
        ]);
    }

    private function veirificarDisciplina(string $matriculaID, string $disciplinaID)
    {
        $disciplina = $this->disciplinas
            ->where('matriculas_id', $matriculaID)
            ->where('disciplinas_id', $disciplinaID)
            ->get();

        if ($disciplina->count() >= 1) {
            return true;
        } else {
            return false;
        }
    }
}
