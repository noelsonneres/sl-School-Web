<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use DateTime;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class CursosController extends Controller
{

    const PATH = 'screens.curso.';
    private $curso;

    public function __construct()
    {
        $this->curso = new Curso();
    }

    public function index()
    {
        $curso = $this->curso
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')->paginate();
        return view(self::PATH . 'cursoShow', ['cursos' => $curso]);
    }

    public function create()
    {
        return view(self::PATH . 'cursoCreate');
    }

    public function store(Request $request)
    {
        $cursos = $this->curso;

        $request->validate([
            'curso' => 'required|min:3|max:50',
            'qtdeParcelas' => 'required',
            'duracao' => 'required',
            'cargaHoraria' => 'required',
            'ativo' => 'required',
        ], [
            'curso.required' => 'O campo curso é obrigatório',
            'curso.min' => 'Digite um nome para o curso com mais de três caracteres',
            'curso.max' => 'digite um nome para o curso com menos de 50 caracteres',
            'qtdeParcelas.required' => 'O campo Qtde. Parcelas é obrigatório',
            'duracao.required' => 'O campo Duração é obrigatório',
            'cargaHoraria.required' => 'O campo Carga horária é obrigatório',
            'ativo.required' => 'O campo Ativo é obrigatório',
        ]);

        $curso = $request->old('curso');
        $qtdeParcelas = $request->old('qtdeParcelas');
        $duracao = $request->old('duracao');
        $cargaHoraria = $request->old('cargaHoraria');
        $Ativo = $request->old('ativo');

        try {

            $cursos->empresas_id = auth()->user()->empresas_id;
            $cursos->curso = $request->input('curso');
            $cursos->descricao = $request->input('descricao');
            $cursos->valor_avista = $request->input('valorAVista');
            $cursos->valor_com_desconto = $request->input('valorComDesconto');
            $cursos->qtde_parcelas = $request->input('qtdeParcelas');
            $cursos->valor_por_parcela = $request->input('valorPorParcela');
            $cursos->duracao = $request->input('duracao');
            $cursos->carga_horaria = $request->input('cargaHoraria');
            $cursos->ativo = $request->input('ativo');
            $cursos->obs = $request->input('obs');
            $cursos->deletado = 'nao';
            $cursos->auditoria = $this->operacao('Cadastro Cursos');

            $cursos->save();

            $cursos = $this->curso
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')->paginate();
            return view(self::PATH . 'cursoShow', ['cursos' => $cursos])
                    ->with('msg', 'Sucesso! Curso cadastrado com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível cadastrar as informações do curso: ' . $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $curso = $this->curso->find($id);
        return view(self::PATH.'cursoEdit', ['curso'=>$curso]);
    }

    public function update(Request $request, string $id)
    {
        $cursos = $this->curso->find($id);

        $request->validate([
            'curso' => 'required|min:3|max:50',
            'qtdeParcelas' => 'required',
            'duracao' => 'required',
            'cargaHoraria' => 'required',
            'ativo' => 'required',
        ], [
            'curso.required' => 'O campo curso é obrigatório',
            'curso.min' => 'Digite um nome para o curso com mais de três caracteres',
            'curso.max' => 'digite um nome para o curso com menos de 50 caracteres',
            'qtdeParcelas.required' => 'O campo Qtde. Parcelas é obrigatório',
            'duracao.required' => 'O campo Duração é obrigatório',
            'cargaHoraria.required' => 'O campo Carga horária é obrigatório',
            'ativo.required' => 'O campo Ativo é obrigatório',
        ]);

        $curso = $request->old('curso');
        $qtdeParcelas = $request->old('qtdeParcelas');
        $duracao = $request->old('duracao');
        $cargaHoraria = $request->old('cargaHoraria');
        $Ativo = $request->old('ativo');

        try {

            $cursos->curso = $request->input('curso');
            $cursos->descricao = $request->input('descricao');
            $cursos->valor_avista = $request->input('valorAVista');
            $cursos->valor_com_desconto = $request->input('valorComDesconto');
            $cursos->qtde_parcelas = $request->input('qtdeParcelas');
            $cursos->valor_por_parcela = $request->input('valorPorParcela');
            $cursos->duracao = $request->input('duracao');
            $cursos->carga_horaria = $request->input('cargaHoraria');
            $cursos->ativo = $request->input('ativo');
            $cursos->obs = $request->input('obs');
            $cursos->deletado = 'nao';
            $cursos->auditoria = $this->operacao('Atualizar informações do curso');

            $cursos->save();

            $cursos = $this->curso
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')->paginate();
            return view(self::PATH . 'cursoShow', ['cursos' => $cursos])
                    ->with('msg', 'Sucesso! As informações do curso foram atualizadas com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível atualizar as informações do curso: ' . $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $curso = $this->curso->find($id);
        
        if($curso->count() >= 1){

            try {

                $curso->deletado = 'sim';
                $curso->auditoria = $this->operacao('Atualizar informações do excluidas');

                $curso->save();

                $curso = $this->curso
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')->paginate();
            return view(self::PATH . 'cursoShow', ['cursos' => $curso])
                    ->with('msg', 'Sucesso! O curso selecionado foi exlcuido com sucesso!');                

            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível excluir o curso selecionado ' . $th->getMessage()]);
            }

        }else{
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível localizar o curso para exclusão']);
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

        $cursos = $this->curso
            ->where($criterio, 'LIKE', '%' . $pesquisa . '%')
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')
            ->paginate();

        return view(self::PATH . 'cursoShow', ['cursos' => $cursos, 'inputs'=>$request->all()]);

    }

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }
}
