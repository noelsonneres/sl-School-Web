
<?php

    // Continuar no porocesso para retornar o nome da disciplina ao recupera as informações
    // das disciplinas do professor

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

            $discProf = $this->discplinaProfessor->find($request->input('professor'));
            return view(self::PATH . 'disciplinasProfessoresShow', ['dsicProf' => $discProf])
                    ->with('msg', 'Disciplina adicionada no registro do professor com sucesso!!!');

        } catch (\Throwable $th) {
            $discProf = $this->discplinaProfessor->find($request->input('professor'));
            return back();
            // return view(self::PATH . 'disciplinasProfessoresCreate', ['dsicProf' => $discProf])
                    // ->with('msg', 'ERRO! Não foi possível adicionar a dicsciplina no registro do professor!');            
        }

    }

    public function show(string $id)
    {

        $discplinaProfessor = $this->discplinaProfessor->find($id);

        $listaDisciplinas = Disciplina::all();
        $professor = Professor::find($id);

        if ($discplinaProfessor) {
            return view(self::PATH . 'disciplinasProfessoresShow', ['dsicProf' => $discplinaProfessor]);
        }else{
            return view(self::PATH.'disciplinasProfessorCreate', ['professor'=>$professor])
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
