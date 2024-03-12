<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\MatriculaTurma;
use App\Models\Turma;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class MatriculaTurmasController extends Controller
{

    const PATH = 'screens.matricula.turma.';
    private $turmas;

    public function __construct()
    {
        $this->turmas  = new MatriculaTurma();
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
        $turmas = $this->turmas->where('matriculas_id', $id)->paginate();
        $matriculaInfo = Matricula::find($id);
        return view(self::PATH.'turmaShow', ['turmas'=>$turmas, 'matriculaInfo'=>$matriculaInfo]);
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

    public function visualizarTurmas(string $matriculaID){

        $listaTurmas = Turma::paginate();
        return view(self::PATH.'turmaAdicionar', ['listaTurmas'=>$listaTurmas, 'matriculaID'=>$matriculaID]);

    }

    public function adicionarTurma(string $matricula, string $turma){
        if ($this->verificarTurmaAluno($matricula, $turma) == false){
            $matriculaTurmas = $this->turmas;

            $matriculaTurmas->empresas_id = auth()->user()->empresas_id;
            $matriculaTurmas->matriculas_id = $matricula;
            $matriculaTurmas->turmas_id = $turma;

            $matriculaTurmas->save();

            $turmas = $this->turmas->where('matriculas_id', $matricula)->paginate();
            $matriculaInfo = Matricula::find($matricula);
            return view(self::PATH.'turmaShow', ['turmas'=>$turmas, 'matriculaInfo'=>$matriculaInfo])
                        ->with('msg', 'Sucesso! Turma adicionada com sucesso!');

        }else{
            return redirect()->back()
                            ->withInput()
                            ->withErrors(['ATENÇÃO! Esta turma já esta adicionada à matrícula do aluno']);           
        }
    }

    private function verificarTurmaAluno(string $matricula, string $turma){
        $matriculaTurma = $this->turmas
                        ->where('matriculas_id', $matricula)
                        ->where('turmas_id', $turma)
                        ->get();
        if(!isEmpty($matriculaTurma)){
            return true;
        }else{
            return false;
        }
    }

}
