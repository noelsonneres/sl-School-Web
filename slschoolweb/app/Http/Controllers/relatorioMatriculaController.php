<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;

class relatorioMatriculaController extends Controller
{
    
    const PATH = 'screens.relatorios.matricula.';
    private $matricula;

    public function __construct()
    {
        $this->matricula = new Matricula();
    }

    public function index(){
        $matricula = $this->matricula->paginate()->orderBy('id', 'desck');
        return view(self::PATH.'relatorioMatriculasShow', ['matriculas'=>$matricula]);
    }

    public function localizarMatriculaAlunos(string $alunoID){
        $matricula = $this->matricula->where('alunos_id', $alunoID)->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relatorioMatriculasShow', ['matriculas'=>$matricula]);
    }

}
