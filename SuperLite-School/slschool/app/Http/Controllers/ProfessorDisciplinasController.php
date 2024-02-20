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
            'disciplina'=>'required',
        ],[
            'disciplina.required'=>'O campo disciplina é obrigatório',
        ]);

        $professorID = $request->input('professor');

        //Verificar se a disciplina já não foi adicionada

        try {
            
            $disciplina->empresas_id = auth()->user()->empresas_id;
            $disciplina->professors_id = $request->input('professor');
            $disciplina->disciplinas_id = $request->input('disciplina');
            $disciplina->auditoria = $this->operacao('Adicionou a disciplina');

            $disciplina->save();

            $disciplinas = $this->disciplina
            ->where('professors_id', $professorID)
            ->paginate();

        $listaDisciplinas = Disciplina::all();    

        return view(self::PAHT.'professorDisciplinaShow', ['disciplinas'=>$disciplinas,
                                'professor'=>$professorID,
                                'listaDisciplinas'=>$listaDisciplinas])
                                ->with('msg', 'Sucesso! Disciplina adicionada com sucesso!');            

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível adicionar a disciplina para o professor: '.$th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        $disciplinas = $this->disciplina
            ->where('professors_id', $id)
            ->paginate();

        $listaDisciplinas = Disciplina::all();    

        return view(self::PAHT.'professorDisciplinaShow', ['disciplinas'=>$disciplinas,
                                'professor'=>$id,
                                'listaDisciplinas'=>$listaDisciplinas]);
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

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }    

}
