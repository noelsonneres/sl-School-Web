<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use DateTime;
use Illuminate\Http\Request;

class DisciplinasController extends Controller
{

    const PATH = 'screens.disciplina.';
    private $disciplina;

    public function __construct()
    {
        $this->disciplina = new Disciplina();
    }

    public function index()
    {
        $disciplinas = $this->disciplina
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')
            ->paginate();
        return view(self::PATH . 'disciplinasShow', ['disciplinas' => $disciplinas]);
    }

    public function create()
    {
        return view(self::PATH . 'disciplinasCreate');
    }

    public function store(Request $request)
    {

        $disciplina = $this->disciplina;

        $request->validate([
            'disciplina' => 'required|min:3|max:50',
            'descricao' => 'required|min:3|max:100',
        ], [
            'disciplina.required' => 'O campo disciplina é obrigatório',
            'disciplina.min' => 'O campo disciplina deve ter no mínimo três caracteres',
            'disciplina.max' => 'O campo disciplina deve ter no máximo 50 caracteres',
            'descricao.required' => 'O campo descrição é obrigatório',
            'descricao.min' => 'O campo descrição deve ter no mínimmo três caracteres',
            'descricao.max' => 'O campo descrição deve ter no máximo 100 caracteres',
        ]);

        $disciplinas = $request->old('disciplina');
        $descricao = $request->old('descricao');

        try {
            $disciplina->empresas_id = auth()->user()->empresas_id;
            $disciplina->disciplina = $request->input('disciplina');
            $disciplina->descricao = $request->input('descricao');
            $disciplina->duracao_meses = $request->input('duracaoMeses');
            $disciplina->carga_horaria = $request->input('cargaHoraria');
            $disciplina->observacao = $request->input('obs');
            $disciplina->deletado = 'nao';
            $disciplina->auditoria = $this->operacao('Cadastrou a nova disciplina');
            $disciplina->save();

            $disciplinas = $this->disciplina
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate();
            return view(self::PATH . 'disciplinasShow', ['disciplinas' => $disciplinas])
                ->with('msg', 'Sucesso! Disciplina cadastrada com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível inserir as informações da disciplina no banco de dados: ' . $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $disciplina = $this->disciplina->find($id);
        return view(self::PATH . 'disciplinasEdit', ['disciplina' => $disciplina]);
    }

    public function update(Request $request, string $id)
    {
        $disciplina = $this->disciplina->find($id);

        $request->validate([
            'disciplina' => 'required|min:3|max:50',
            'descricao' => 'required|min:3|max:100',
        ], [
            'disciplina.required' => 'O campo disciplina é obrigatório',
            'disciplina.min' => 'O campo disciplina deve ter no mínimo três caracteres',
            'disciplina.max' => 'O campo disciplina deve ter no máximo 50 caracteres',
            'descricao.required' => 'O campo descrição é obrigatório',
            'descricao.min' => 'O campo descrição deve ter no mínimmo três caracteres',
            'descricao.max' => 'O campo descrição deve ter no máximo 100 caracteres',
        ]);

        $disciplinas = $request->old('disciplina');
        $descricao = $request->old('descricao');

        try {
            $disciplina->empresas_id = auth()->user()->empresas_id;
            $disciplina->disciplina = $request->input('disciplina');
            $disciplina->descricao = $request->input('descricao');
            $disciplina->duracao_meses = $request->input('duracaoMeses');
            $disciplina->carga_horaria = $request->input('cargaHoraria');
            $disciplina->observacao = $request->input('obs');
            $disciplina->deletado = 'nao';
            $disciplina->auditoria = $this->operacao('Atualizou as informações da disciplina');
            $disciplina->save();

            $disciplinas = $this->disciplina
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate();
            return view(self::PATH . 'disciplinasShow', ['disciplinas' => $disciplinas])
                ->with('msg', 'Sucesso! Informações da disciplina atualizadas com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível atualizar as informações da disciplina no banco de dados: ' . $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $disciplina = $this->disciplina->find($id);

        if ($disciplina != null) {

            try {
                
                $disciplina->deletado = 'sim';
                $disciplina->auditoria = $this->operacao('deletou esta disciplina');
                $disciplina->save();
    
                $disciplinas = $this->disciplina
                    ->where('empresas_id', auth()->user()->empresas_id)
                    ->where('deletado', 'nao')
                    ->orderBy('id', 'desc')
                    ->paginate();
                return view(self::PATH . 'disciplinasShow', ['disciplinas' => $disciplinas])
                    ->with('msg', 'Sucesso! Disciplina excluida com sucesso!');

            } catch (\Throwable $th) {
                return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível excluir a disciplina selecionada: '].$th->getMessage());   
            }

        }else{
            return redirect()->back()->withInput()
            ->withErrors(['ERRO! Não foi possível localizar a disciplina para exclusão!']);            
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

        $disciplinas = $this->disciplina
            ->where($criterio, 'LIKE', '%' . $pesquisa . '%')
            ->where('empresas_id', auth()->user()->empresas_id)
            ->orderBy('id', 'desc')
            ->paginate();

        return view(self::PATH . 'disciplinasShow', ['disciplinas' => $disciplinas, 'inputs' => $request->all()]);
    }    

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }
}
