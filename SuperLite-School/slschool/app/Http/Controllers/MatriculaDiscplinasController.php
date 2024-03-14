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
        //
    }

    public function show(string $id)
    {
        $disciplinas = $this->disciplinas->where('matriculas_id', $id)->orderBy('id', 'desc')->paginate();
        $matricula = Matricula::find($id);
        return view(self::PATH.'disciplinaShow', ['disciplinas'=>$disciplinas, 'matricula'=>$matricula]);
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

    public function novaDisciplina(string $matriculaID, string $aluno){
        $listaDisciplinas = Disciplina::paginate();
        return view(self::PATH.'disciplinasCreate', [
                            'listaDisciplinas'=>$listaDisciplinas, 
                            'matriculaID'=>$matriculaID, 
                            'aluno'=>$aluno]);
    }

}
