<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\ProfessorDisciplina;
use DateTime;
use Illuminate\Http\Request;

class ProfessorDisciplinasController extends Controller
{

    const PAHT = 'screens.professorDisciplina.';
    private $disciplina;

    public function __construct()
    {
        $this->disciplina = new ProfessorDisciplina();
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

        $request->validate([
            'disciplina' => 'required',
        ], [
            'disciplina.required' => 'O campo disciplina é obrigatório',
        ]);

        $professorID = $request->input('professor');
        $disciplinaID = $request->input('disciplina');

        if ($this->verificarInclusao($professorID, $disciplinaID) == true) {
            return redirect()->back()->withInput()
                ->withErrors(['ATENÇÃO! Esta disciplina já foi adicionada para o professor']);
        } else {
            try {

                $disciplina->empresas_id = auth()->user()->empresas_id;
                $disciplina->professors_id = $request->input('professor');
                $disciplina->disciplinas_id = $disciplinaID;
                $disciplina->auditoria = $this->operacao('Adicionou a disciplina');

                $disciplina->save();

                $disciplinas = $this->disciplina
                    ->where('professors_id', $professorID)
                    ->orderBy('id', 'desc')
                    ->paginate();

                $listaDisciplinas = Disciplina::all();

                return view(self::PAHT . 'professorDisciplinaShow', [
                    'disciplinas' => $disciplinas,
                    'professor' => $professorID,
                    'listaDisciplinas' => $listaDisciplinas
                ])
                    ->with('msg', 'Sucesso! Disciplina adicionada com sucesso!');
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()
                    ->withErrors(['ERRO! Não foi possível adicionar a disciplina para o professor: ' . $th->getMessage()]);
            }
        }
    }

    public function show(string $id)
    {
        $disciplinas = $this->disciplina
            ->where('professors_id', $id)
            ->orderBy('id', 'desc')
            ->paginate();

        $listaDisciplinas = Disciplina::all();

        return view(self::PAHT . 'professorDisciplinaShow', [
            'disciplinas' => $disciplinas,
            'professor' => $id,
            'listaDisciplinas' => $listaDisciplinas
        ]);
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
        $disciplina = $this->disciplina->find($id);
        $professorID = $disciplina->professors_id;

        if ($disciplina != null) {
            
            $disciplina->delete();

            $disciplinas = $this->disciplina
                ->where('professors_id', $professorID)
                ->orderBy('id', 'desc')
                ->paginate();

            $listaDisciplinas = Disciplina::all();

            return view(self::PAHT . 'professorDisciplinaShow', [
                'disciplinas' => $disciplinas,
                'professor' => $professorID,
                'listaDisciplinas' => $listaDisciplinas
            ])
                ->with('msg', 'Sucesso! Disciplina removida com sucesso!');

        } else {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível excluir a disciplina do professor']);
        }
    }

    private function verificarInclusao(String $professorID, String $disciplinaID)
    {
        $disciplina = $this->disciplina
            ->where('professors_id', $professorID)
            ->where('disciplinas_id', $disciplinaID)
            ->get();

        if ($disciplina->count() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }
}
