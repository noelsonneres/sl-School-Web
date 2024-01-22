<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class RelatorioAlunosController extends Controller
{
    
    const PATH = 'screens.relatorios.aluno.';
    private $aluno;

    public function __construct()
    {
        $this->aluno = new Aluno();
    }

    public function index(){
        $alunos = $this->aluno->where('id', 0)->paginate();
        return view(self::PATH.'relAlunosShow', ['alunos'=>$alunos]);
    }

}
