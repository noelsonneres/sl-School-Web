<?php

namespace App\Http\Controllers;

use App\Models\MatriculaTurma;
use Illuminate\Http\Request;
use App\Models\Turma;

class AlunosPorTurmaController extends Controller
{

    const PATH = 'screens.alunosPorTurma.';
    
    public function index(){

        $turmaMatriculas = MatriculaTurma::where('turmas_id', 0)->get();

        $listaTurmas = Turma::all();
        return view(self::PATH.'alunoTurmaShow', 
                ['listaTurmas'=>$listaTurmas, 'turmaMatriculas'=>$turmaMatriculas]);

    }

    public function selecionarAlunos(Request $request){

        $turmaID = $request->input('selecionar');

        $turmaMatriculas = MatriculaTurma::where('turmas_id', $turmaID)->get();

        $turma = Turma::find($turmaID);

        $listaTurmas = Turma::all();
        return view(self::PATH.'alunoTurmaShow', 
                ['listaTurmas'=>$listaTurmas, 'turmaMatriculas'=>$turmaMatriculas]);

    }

}
