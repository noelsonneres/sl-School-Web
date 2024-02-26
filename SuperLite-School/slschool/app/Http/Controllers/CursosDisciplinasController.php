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
    }

    public function store(Request $request)
    {
        $disciplina = $this->cursoDisciplina;

        $request->validate([
            'curso' => 'required',
            'disciplina' => 'required',
        ], [
            'curso.required' => 'Selecione um curso antes de adicionar a disciplina',
            'disciplina.required' => 'Selecione uma disciplina',
        ]);

        $cursoID = $request->input('curso');
        $disciplinaID = $request->input('disciplina');

        if($this->verificar($cursoID, $disciplinaID) == 0){
            try {

                $disciplina->empresas_id = auth()->user()->empresas_id;
                $disciplina->cursos_id = $cursoID;
                $disciplina->disciplinas_id = $disciplinaID;
    
                $disciplina->save();
    
                $disciplinas = $this->cursoDisciplina->where('cursos_id', $cursoID)->orderBy('id', 'desc')->paginate();
                $listaDisciplinas = Disciplina
                    ::where('empresas_id', auth()->user()->empresas_id)
                    ->where('deletado', 'nao')
                    ->get();
    
                $curso = Curso::find($cursoID);
    
                return view(self::PATH . 'cursoDisciplinaShow', [
                    'disciplinas' => $disciplinas,
                    'curso' => $curso,
                    'listaDisciplinas' => $listaDisciplinas
                ])
                    ->with('msg', 'Sucesso! Disciplina adicionada com sucesso!');
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível incluir a disciplina: ' . $th->getMessage()]);
            }
        }else{
            return redirect()->back()->withInput()->withErrors(['ERRO! Este disciplina já esta adicionada ao curso!']);            
        }

      
    }

    public function show(string $id)
    {
        $disciplinas = $this->cursoDisciplina->where('cursos_id', $id)->orderBy('id', 'desc')->paginate();

        $listaDisciplinas = Disciplina
            ::where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->get();

        $curso = Curso::find($id);

        return view(self::PATH . 'cursoDisciplinaShow', [
            'disciplinas' => $disciplinas,
            'curso' => $curso,
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
        $disciplina = $this->cursoDisciplina->find($id);
        $cursoID = $disciplina->cursos_id;
        if ($disciplina->count() >= 1) {

            try {
                $disciplina->delete();

                $disciplinas = $this->cursoDisciplina->where('cursos_id', $cursoID)->orderBy('id', 'desc')->paginate();
                $listaDisciplinas = Disciplina
                    ::where('empresas_id', auth()->user()->empresas_id)
                    ->where('deletado', 'nao')
                    ->get();

                $curso = Curso::find($cursoID);

                return view(self::PATH . 'cursoDisciplinaShow', [
                    'disciplinas' => $disciplinas,
                    'curso' => $curso,
                    'listaDisciplinas' => $listaDisciplinas
                ])
                    ->with('msg', 'Sucesso! Disciplina excluida com sucesso!');
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível excluir a disciplina: ' . $th->getMessage()]);
            }
        } else {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível localizar a disciplina para exclusão!']);
        }
    }

    private function verificar(string $curso, string $disciplina)
    {

        $disciplina = $this->cursoDisciplina->where('cursos_id', $curso)
            ->where('disciplinas_id', $disciplina)
            ->get();

        if($disciplina->count() == 0){
            return 0;
        }else{
            return 1;
        }
    }
}
