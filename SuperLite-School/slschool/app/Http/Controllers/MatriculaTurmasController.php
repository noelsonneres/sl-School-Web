<?php

namespace App\Http\Controllers;

use App\Models\DiasAula;
use App\Models\HorariosAula;
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
        return view(self::PATH . 'turmaShow', ['turmas' => $turmas, 'matriculaInfo' => $matriculaInfo]);
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

    public function visualizarTurmas(string $matriculaID)
    {
        $listaTurmas = Turma::where('deletado', 'nao')->paginate();
        return view(self::PATH . 'turmaAdicionar', ['listaTurmas' => $listaTurmas, 'matriculaID' => $matriculaID]);
    }

    public function adicionarTurma(string $matricula, string $turma)
    {
        if ($this->verificarTurmaAluno($matricula, $turma) == false) {

            if ($this->verificarVagas($turma) == false) {

                $matriculaTurmas = $this->turmas;

                $matriculaTurmas->empresas_id = auth()->user()->empresas_id;
                $matriculaTurmas->matriculas_id = $matricula;
                $matriculaTurmas->turmas_id = $turma;

                $matriculaTurmas->save();

                $turmas = $this->turmas->where('matriculas_id', $matricula)->paginate();
                $matriculaInfo = Matricula::find($matricula);
                return view(self::PATH . 'turmaShow', ['turmas' => $turmas, 'matriculaInfo' => $matriculaInfo])
                    ->with('msg', 'Sucesso! Turma adicionada com sucesso!');

            } else {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['ATENÇÃO! A Turma selecionada já esta completa. Tente outra turma!']);
            }

        }else{
            return redirect()->back()
            ->withInput()
            ->withErrors(['ATENÇÃO! Esta turma já esta adicionada à matrícula do aluno']);
        }
    }

    public function search(Request $request)
    {

        $request->validate([
            'criterio' => 'required',
            'pesquisa' => 'required',
        ], [
            'criterio.required' => 'Selecione um criterio de pesquisa',
            'pesquisa.required' => 'Digite o que deseja pesquisar',
        ]);

        $criterio = $request->input('criterio') ?? 'id';
        $pesquisa = $request->input('pesquisa');
        $matriculaID = $request->input('matricula');

        if ($criterio == 'dia') {
            $dias = DiasAula::where('dia', 'LIKE', '%' . $pesquisa . '%')->get();
            $pesquisa = $dias[0]->id;
            $criterio = 'dias_aulas_id';
        } else if ($criterio == 'horario') {
            $horarios = HorariosAula::where('entrada', 'LIKE', '%' . $pesquisa . '%')->get();
            $pesquisa = $horarios[0]->id;
            $criterio = 'horarios_aulas_id';
        }

        $listaTurmas = Turma::where($criterio, 'LIKE', '%' . $pesquisa . '%')
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->paginate();

        return view(self::PATH . 'turmaAdicionar', ['listaTurmas' => $listaTurmas, 'matriculaID' => $matriculaID, 'inputs' => $request->all()]);
    }

    private function verificarTurmaAluno(string $matricula, string $turma)
    {
        $matriculaTurma = $this->turmas
            ->where('matriculas_id', $matricula)
            ->where('turmas_id', $turma)
            ->get();
        if ($matriculaTurma->count() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    private function verificarVagas(string $turmaID)
    {
        $turma = Turma::find($turmaID);
        $matriculaTurma = MatriculaTurma::where('turmas_id', $turmaID)->get();

        $vagasTurmas = $turma->salas_aulas->vagas;
        $totalAlunoTurma = $matriculaTurma->count();

        $vagas = $vagasTurmas - $totalAlunoTurma;

        if ($totalAlunoTurma >= $vagasTurmas) {
            return true;
        } else {
            return false;
        }
    }
}
