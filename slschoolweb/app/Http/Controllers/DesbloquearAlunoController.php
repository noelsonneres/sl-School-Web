<?php

namespace App\Http\Controllers;

use App\Models\AlunoBloqueado;
use Illuminate\Http\Request;

class DesbloquearAlunoController extends Controller
{

    const PATH = 'screens.alunos.bloqueados.';
    private $desbloquear;

    public function __construct()
    {
        $this->desbloquear = new AlunoBloqueado();
    }

    public function visualizarInfo(String $alunosID)
    {

        $lista = $this->desbloquear->where('alunos_id', $alunosID)->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'desbloquearAlunos', ['listas' => $lista]);
    }

    public function desbloquear(string $id)
    {
    }

    private function reativarMatriculas(String $matriculaID)
    {
    }

    private function reativarAluno(String $alunoID)
    {
    }
}
