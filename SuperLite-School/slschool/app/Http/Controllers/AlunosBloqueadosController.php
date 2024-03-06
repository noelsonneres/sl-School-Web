<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\AlunoBloqueado;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class AlunosBloqueadosController extends Controller
{

    const PATH = 'screens.alunoBloqueado.';
    private $bloqueados;

    public function __construct()
    {
        $this->bloqueados = new AlunoBloqueado();
    }

    public function index()
    {
        $bloqueados = $this->bloqueados
            ->where('empresas_id', auth()->user()->empresas_id)
            ->orderBy('id', 'desc')
            ->paginate();
        return view(self::PATH . 'alunoBloqueadoShow', ['bloqueados' => $bloqueados]);
    }

    public function create()
    {
        return view(self::PATH . 'alunoBloqueadoCreate');
    }

    public function store(Request $request)
    {

        $bloqueado = $this->bloqueados;

        $request->validate([
            'aluno' => 'required',
            'data' => 'required',
            'hora' => 'required',
            'motivo' => 'required|min:3|max:50',
        ], [
            'aluno.required' => 'Você deve selecionar um alunos',
            'data.required' => 'Informe uma data valida',
            'hora.required' => 'Informe um horário valido',
            'motivo.required' => 'O campo Motivo é obrigatório',
            'motivo.min' => 'O motivo deve ter mais que três caracteres',
            'motivo.max' => 'O motivo deve ter menos que 50 caracteres',
        ]);

        $data = $request->old('data');
        $hora = $request->old('hora');
        $motivo = $request->old('motivo');

        $alunoID = $request->input('aluno');

        try {

            $bloqueado->empresas_id = auth()->user()->empresas_id;
            $bloqueado->alunos_id = $request->input('aluno');
            $bloqueado->data = $request->input('data');
            $bloqueado->hora = $request->input('hora');
            $bloqueado->motivo = $request->input('motivo');
            $bloqueado->status = 'bloqueado';
            // $bloqueado->data_desbloqueio = Carbon::now()->format('d-m-Y');
            $bloqueado->obs = $request->input('obs');
            $bloqueado->auditoria = $this->operacao('Bloqueo o aluno');

            $bloqueado->save();

            $this->atualizarStatusAluno($alunoID, 'bloqueado');
            $this->atualizarStatusMatricula($alunoID, 'bloqueado');

            $bloqueados = $this->bloqueados
                ->where('empresas_id', auth()->user()->empresas_id)
                ->orderBy('id', 'desc')
                ->paginate();
            return view(self::PATH . 'alunoBloqueadoShow', ['bloqueados' => $bloqueados])
                ->with('msg', 'Sucesso! Aluno bloqueado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível bloquear o aluno: ' . $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $bloqueado = $this->bloqueados->find($id);
        return view(self::PATH . 'alunoDesbloquear', ['bloqueado' => $bloqueado]);
    }

    public function update(Request $request, string $id)
    {
        $bloqueado = $this->bloqueados->find($id);

        $request->validate([
            'aluno' => 'required',
            'data' => 'required',
            'hora' => 'required',
            'motivo' => 'required|min:3|max:50',
        ], [
            'aluno.required' => 'Você deve selecionar um alunos',
            'data.required' => 'Informe uma data valida',
            'hora.required' => 'Informe um horário valido',
            'motivo.required' => 'O campo Motivo é obrigatório',
            'motivo.min' => 'O motivo deve ter mais que três caracteres',
            'motivo.max' => 'O motivo deve ter menos que 50 caracteres',
        ]);

        $data = $request->old('data');
        $hora = $request->old('hora');
        $motivo = $request->old('motivo');

        $alunoID = $request->input('aluno');

        try {

            $bloqueado->status = 'desbloqueado';
            $bloqueado->data_desbloqueio = Carbon::now()->format('Y-m-d');
            $bloqueado->obs = $request->input('obs');
            $bloqueado->auditoria = $this->operacao('Desbloqueou o aluno');

            $bloqueado->save();

            $this->atualizarStatusAluno($alunoID, 'ativo');
            $this->atualizarStatusMatricula($alunoID, 'ativo');

            $bloqueados = $this->bloqueados
                ->where('empresas_id', auth()->user()->empresas_id)
                ->orderBy('id', 'desc')
                ->paginate();
            return view(self::PATH . 'alunoBloqueadoShow', ['bloqueados' => $bloqueados])
                ->with('msg', 'Sucesso! Aluno bloqueado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível bloquear o aluno: ' . $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        //
    }

    public function selecionarAluno()
    {
        $alunos = Aluno::where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')
            ->paginate();
        return view(self::PATH . 'alunoBloqueadoSelecionar', ['alunos' => $alunos]);
    }

    public function localizarAluno(Request $request)
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

        $alunos = Aluno::where($criterio, 'LIKE', '%' . $pesquisa . '%')
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->paginate();

        return view(self::PATH . 'alunoBloqueadoSelecionar', ['alunos' => $alunos, 'inputs' => $request->all()]);
    }

    public function iniciarBloqueio(string $nome, string $id)
    {
        $aluno = Aluno::find($id);

        if ($aluno->ativo == 'ativo') {
            return view(self::PATH . 'alunoBloqueadoCreate', ['nome' => $nome, 'id' => $id]);
        } else {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! O aluno selecionado já esta bloqueado!']);
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

        if ($criterio === 'nome' or $criterio === 'cpf') {

            $aluno = Aluno::where($criterio, 'LIKE', '%' . $pesquisa)->get();
            $pesquisa = $aluno->id;
        }

        $bloqueado = $this->bloqueados->where($criterio, 'LIKE', '%' . $pesquisa . '%')
            ->where('empresas_id', auth()->user()->empresas_id)
            ->paginate();

            return view(self::PATH . 'alunoBloqueadoShow', ['bloqueados' => $bloqueado, 'inputs'=>$request->all()]);
    }

    private function atualizarStatusAluno(string $alunoID, string $status)
    {
        $aluno = Aluno::find($alunoID);
        if ($aluno->count() >= 1) {

            try {

                $aluno->ativo = $status;
                $aluno->auditoria = $this->operacao('Bloqueou o aluno');
                $aluno->save();
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()
                    ->withErrors(['ERRO! Não foi possível bloquear o aluno: ' . $th->getMessage()]);
            }
        } else {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível localizar o aluno! ']);
        }
    }

    private function atualizarStatusMatricula(string $alunoID, string $status)
    {
        return true;
    }

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }
}
