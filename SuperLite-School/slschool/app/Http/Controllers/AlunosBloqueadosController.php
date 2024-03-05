<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\AlunoBloqueado;
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
            'aluno'=>'required',
            'data'=>'required',
            'hora'=>'required',
            'motivo'=>'required|min:3|max:50',
        ],[
            'aluno.required'=>'Você deve selecionar um alunos',
            'data.required'=>'Informe uma data valida',
            'hora.required'=>'Informe um horário valido',
            'motivo.required'=>'O campo Motivo é obrigatório',
            'motivo.min'=>'O motivo deve ter mais que três caracteres',
            'motivo.max'=>'O motivo deve ter menos que 50 caracteres',
        ]);

        // Continuar deste ponto em diante

    }

    public function show(string $id)
    {
        //
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

    public function selecionarAluno()
    {
        $alunos = Aluno::where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
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
        return view(self::PATH . 'alunoBloqueadoCreate', ['nome' => $nome, 'id' => $id]);
    }

    private function atualizarStatusAluno(string $alunoID)
    {

    }

    private function atualizarStatusMatricula()
    {
        return true;
    }
}
