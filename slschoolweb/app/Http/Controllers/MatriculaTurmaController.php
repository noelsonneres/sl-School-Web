<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\MatriculaTurma;
use App\Models\Responsavel;
use App\Models\Turma;
use Illuminate\Http\Request;

class MatriculaTurmaController extends Controller
{

    const PATH = 'screens.alunos.turma.';
    private $turmas;

    public function __constructor()
    {
        $this->turmas = new MatriculaTurma();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        $turma = MatriculaTurma::with('turmas')->where('matriculas_id', $id);
        return view(self::PATH . 'matriculaTurmaShow', ['turmas'=>$turma]);
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

    public function listaTurmas(string $alunoID, string $matriculaID){

        $aluno = Aluno::find($alunoID)->first();
        $responsavel = Responsavel::where('alunos_id', $alunoID)->first();
        $turma = MatriculaTurma::where('matriculas_id', $matriculaID)->paginate();

        if($turma->count() >= 1){
//            return view(self::PATH.'matriculaTurmaShow', ['turmas'=>$turma])
//                            ->with('aluno', $aluno)
//                            ->with('responsavel', $responsavel);
        }else{
            return view(self::PATH.'matriculaTurmaShow', ['turmas'=>$turma])
                ->with('aluno', $aluno)
                ->with('responsavel', $responsavel)
                ->with('matricula', $matriculaID);
        }


    }

    public function inserir(Request $request, string $matriculaID){
       
        // $turma = $this->turmas;

        // $request->validate([
        //     'turma' => 'required',
        //     'matricula' => 'required',
        // ]);

        $listaTurmas = Turma::paginate();
        
        return view(self::PATH.'matriculaTurmasCreate', ['matricula'=>$matriculaID])
                    ->with('listaTurmas', $listaTurmas);
    }

    public function adicionar(Request $request){

    // CONTINUAR DESTA PARTE

    }

}
