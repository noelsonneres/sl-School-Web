<?php

namespace App\Http\Controllers;

use App\Models\Curso;
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

    public function listar(string $id, string $curso)
    {

        $cursosDisciplinas = $this->cursosDisciplinas->with('disciplinas')->where('cursos_id', $id)->paginate();
        return view(self::PATH . 'cursosDisciplinasShow', ['disciplinas' => $cursosDisciplinas])
            ->with('curso', $curso)
            ->with('cursoId', $id);
    }

    public function adicionar(string $id)
    {

        $disciplinas = Disciplina::all();

        // dd($id);

        if ($id) {
            return view(self::PATH . 'cursosDisciplinaCreate')
                ->with('cursoID', $id)
                ->with('disciplinas', $disciplinas);
        }
    }

    public function salvar(Request $request)
    {

        $cursosDisciplinas = $this->cursosDisciplinas;

        $request->validate([
            'curso' => 'required',
            'disciplina' => 'required',
        ]);

        $curso = $request->input('curso');
        $dadosCurso = Curso::find($curso);
        $dadosCurso = $dadosCurso->curso;

        try {

            $cursosDisciplinas->cursos_id = $request->input('curso');
            $cursosDisciplinas->disciplinas_id = $request->input('disciplina');

            $cursosDisciplinas->save();

            $cursosDisciplinas = $this->cursosDisciplinas
                ->with('disciplinas')
                ->where('cursos_id', $curso)
                ->paginate();

            return view(self::PATH . 'cursosDisciplinasShow', ['disciplinas' => $cursosDisciplinas])
                ->with('cursoId', $curso)
                ->with('curso', $dadosCurso)
                ->with('msg', 'Disciplina incluida com sucesso!!!');
        } catch (\Throwable $th) {

            $cursosDisciplinas = $this->cursosDisciplinas
                ->with('disciplinas')
                ->where('cursos_id', $curso)
                ->paginate();

            return view(self::PATH . 'cursosDisciplinasShow', ['disciplinas' => $cursosDisciplinas])
                ->with('cursoId', $curso)
                ->with('curso', $dadosCurso)
                ->with('msg', 'ERRO! Houve um problema ao tentar inserir os ');
        }
    }

    public function deletar(string $id)
    {

        $disciplina = $this->cursosDisciplinas->find($id);

        $cursoID = $disciplina->cursos_id;

        $dadosCurso = Curso::find($cursoID);
        $dadosCurso = $dadosCurso->curso;

        if ($disciplina) {
            $disciplina->delete();


            $cursosDisciplinas = $this->cursosDisciplinas
                ->with('disciplinas')
                ->where('cursos_id', $cursoID)
                ->paginate();

            return view(self::PATH . 'cursosDisciplinasShow', ['disciplinas' => $cursosDisciplinas])
                ->with('cursoId', $cursoID)
                ->with('curso', $dadosCurso)
                ->with('msg', 'Disciplina removida com sucesso!');
        }else{

            $cursosDisciplinas = $this->cursosDisciplinas
                ->with('disciplinas')
                ->where('cursos_id', $cursoID)
                ->paginate();

            return view(self::PATH . 'cursosDisciplinasShow', ['disciplinas' => $cursosDisciplinas])
                ->with('cursoId', $cursoID)
                ->with('curso', $dadosCurso)
                ->with('msg', 'ERRO! Não foi possível remove a disciplina do curso!');

        }
    }
}
