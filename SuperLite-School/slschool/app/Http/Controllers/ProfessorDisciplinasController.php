<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\ProfessorDisciplina;
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
        //
    }

    public function show(string $id)
    {
        $disciplinas = $this->disciplina
            ->where('professors_id')
            ->paginate();

        $listaDisciplinas = Disciplina::all();    

        return view(self::PAHT.'professorDisciplinaShow', ['disciplinas'=>$disciplinas, 'listaDisciplinas'=>$listaDisciplinas]);
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
}
