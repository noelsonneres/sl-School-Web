<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class HomeAlunosController extends Controller
{

    const PATH = 'screens.alunos.';

    private $alunos;

    public function __construct()
    {
        $this->alunos = new Aluno();
    }
    
    public function homeAlunos(){

        $alunos = $this->alunos->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'homeShow', ['alunos'=>$alunos]);
    }


}
