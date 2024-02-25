<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\CursosDisciplina;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class CursosDisciplinasController extends Controller
{

    const PATH = 'screens.cursoDisciplina.';
    private $cursoDisciplina;

    public function __construct()
    {
        $this->cursoDisciplina = new CursosDisciplina;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //CRIAR A OPÇÃO PARA INSERÇÃO DAS DISCIPLINAS DO CURSO  
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $disciplinas = $this->cursoDisciplina->where('cursos_id', $id)->paginate();
        $curso = Curso::find($id);

        return view(self::PATH.'cursoDisciplinaShow', ['disciplinas'=>$disciplinas, 'curso'=>$curso]);

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
