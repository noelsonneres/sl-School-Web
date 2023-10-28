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
            $discProf->disciplina = ' ';
    
            $discProf->save();

            // CONTINUAR A PARTIR DESTE PONTO

        } catch (\Throwable $th) {
            //throw $th;
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
