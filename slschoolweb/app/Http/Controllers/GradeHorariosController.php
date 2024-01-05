<?php

namespace App\Http\Controllers;

use App\Models\CadastroDia;
use App\Models\MatriculaTurma;
use App\Models\Reposicao;
use App\Models\Sala;
use App\Models\Turma;
use Illuminate\Http\Request;

class GradeHorariosController extends Controller
{

    const PATH = 'screens.gradeHorarios.';

    public function grade()
    {

        $turmas = Turma::all();

        $listaDias = CadastroDia::all();
        $listaSala = Sala::all();

        return view(self::PATH . 'gradeHorarioshow', ['turmas' => $turmas, 'dias' => $listaDias, 'salas' => $listaSala]);
        
    }

    public function filtrarGrade(Request $request)
    {

        $turmas = new Turma();

        $salaID = $request->input('sala');
        $diaID = $request->input('dia');

        if ($salaID != null and $diaID != null) {
            $turmas = $turmas->where('salas_id', $salaID)->where('cadastro_dias_id', $diaID)->get();
        }else{
            $turmas = $turmas->all();
        }

        $listaDias = CadastroDia::all();
        $listaSala = Sala::all();

        return view(self::PATH . 'gradeHorarioshow', ['turmas' => $turmas, 'dias' => $listaDias, 'salas' => $listaSala]);
    }

    public function gradeAlunos(string $turma){

        $turmas = Turma::find($turma);

        $matriculaTurmas = MatriculaTurma::where('turmas_id', $turma)->get();
        $reposicoes = Reposicao::where('turmas_id', $turma)
                                    ->where('status', 'marcada')
                                    ->whereDate('data_reposicao', '>=', now())
                                    ->get();

        return view(self::PATH.'gradeHorariosAlunos', ['matriculasTurmas'=>$matriculaTurmas,
                                        'reposicoes'=>$reposicoes, 'turma'=>$turmas]);

    }

}
