<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\MatriculaTurma;
use App\Models\Turma;
use Illuminate\Http\Request;

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
        return "Funcionando";
    }

}
