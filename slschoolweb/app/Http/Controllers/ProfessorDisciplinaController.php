<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfessorDisciplina;
use App\Models\Professor;
use App\Models\Disciplina;

class ProfessorDisciplinaController extends Controller
{

    const PATH = 'screens.disciplinasProfessores.';
    public $discplinaProfessor;

    public function __construct()
    {
        $this->discplinaProfessor = new ProfessorDisciplina();
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

        $discProf = $this->discplinaProfessor; 

        try {

            $discProf->professors_id = $request->input('professor');
            $discProf->disciplinas_id = $request->input('opt');

            $discProf->save();

            $professor = Professor::find($request->input('professor'));

            $discProf = $this->discplinaProfessor->with('disciplinas')
                                ->where('professors_id', $request->input('professor'))->paginate();

            return view(self::PATH . 'disciplinasProfessoresShow', ['discProf' => $discProf])
                ->with('professor', $professor)
                ->with('msg', 'Disciplina adicionada no registro do professor com sucesso!!!');

        } catch (\Throwable $th) {
            return ('ERRO! Não foi possível adicionar a dicsciplina no registro do professor!'. $th);
        }
    }

    public function show(string $id)
    {

        $discplinaProfessor = $this->discplinaProfessor->where('professors_id', $id)->get();

        $listaDisciplinas = Disciplina::all();
        $professor = Professor::find($id);

        if ($discplinaProfessor->count() >= 1) {

            $discplinaProfessor = $this->discplinaProfessor->with('disciplinas')->where('professors_id', $id)->paginate();
            return view(self::PATH . 'disciplinasProfessoresShow', ['discProf' => $discplinaProfessor])
                ->with('professor', $professor);
        } else {

            return view(self::PATH . 'disciplinasProfessorCreate', ['professor' => $professor])
                ->with('disciplinas', $listaDisciplinas);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function adicionarDisciplina(string $id)
    {

        $listaDisciplinas = Disciplina::all();
        $professor = Professor::find($id);

        return view(self::PATH . 'disciplinasProfessorCreate', ['professor' => $professor])
            ->with('disciplinas', $listaDisciplinas);
    }
}
