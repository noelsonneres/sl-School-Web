<?php

namespace App\Http\Controllers;

use App\Models\CursosDisciplina;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class CursosDisciplinasController extends Controller
{
    
    const PATH = 'screens.cursosDisciplinas.';
    private $cursosDisciplinas;

    public function __construct()
    {
        $this->cursosDisciplinas = new CursosDisciplina();
    }

    public function listar(string $id, string $curso){

        $cursosDisciplinas = $this->cursosDisciplinas->where('cursos_id', $id)->paginate();
        return view(self::PATH.'cursosDisciplinasShow', ['disciplinas'=>$cursosDisciplinas])
                ->with('curso', $curso);

    }

    public function adicionar(string $id){

        $disciplinas = Disciplina::all();

        if($id){
            return view(self::PATH.'cursosDisciplinaCreate')
                ->with('$CursoID', $id)
                ->with('disciplinas', $disciplinas);
        }

    }

    public function salvar(Request $request){

    }

}
