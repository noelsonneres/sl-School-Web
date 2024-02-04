<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\AlunoBloqueado;
use App\Models\Matricula;
use Carbon\Carbon;
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

    public function desbloquearAluno(string $id)
    {
        $desbloquear = $this->desbloquear->find($id);
        $alunosID = $desbloquear->alunos_id;

        if ($desbloquear->count() >= 1) {

            $dataAtual = Carbon::now();
            $dataAtual = $dataAtual->format('Y/m/d');

            $desbloquear->status = 'desbloqueado';
            $desbloquear->data_desbloqueio = $dataAtual;
            $desbloquear->save();

            $this->reativarMatriculas($alunosID);
            $this->reativarAluno($alunosID);
        }

        $lista = $this->desbloquear->where('alunos_id', $alunosID)->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'desbloquearAlunos', ['listas' => $lista]);
    }

    private function reativarMatriculas(String $alunoID)
    {

        $matriculas = Matricula::where('alunos_id', $alunoID)->get();

        foreach ($matriculas as $matricula) {
            if ($matricula->status == 'bloqueado') {
                $matricula->status = 'ativa';
                $matricula->save();
            }
        }
    }

    private function reativarAluno(String $alunoID)
    {
        $aluno = Aluno::find($alunoID);

        if ($aluno != null) {
            $aluno->ativo = 'sim';
            $aluno->save();
        }
    }

    public function visualizarDetalhes(String $id)
    {
        $alunoBloqueado = $this->desbloquear->find($id);
        if ($alunoBloqueado != null) {
            return view(self::PATH . 'alunosBloqueadosView', ['aluno' => $alunoBloqueado]);
        }        
    }
}
