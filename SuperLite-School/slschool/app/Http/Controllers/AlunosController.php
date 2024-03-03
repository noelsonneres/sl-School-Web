<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use DateTime;
use Illuminate\Http\Request;

class AlunosController extends Controller
{

    const PATH = 'screens.matricula.aluno.';
    private $alunos;

    public function __construct()
    {
        $this->alunos = new Aluno();
    }

    public function index()
    {
        $alunos = $this->alunos
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')
            ->paginate(30);
        return view(self::PATH . 'alunoShow', ['alunos' => $alunos]);
    }

    public function create()
    {
        return view(self::PATH . 'alunoCreate', ['listaEstados' => $this->listaEstados()]);
    }

    public function store(Request $request)
    {

        $alunos = $this->alunos;

        $request->validate([
            'nome' => 'required|min:3|max:100',
            'ativo' => 'required',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O campo nome deve ter no mínimo três caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 100 caractes',
            'ativo.required' => 'Selecione um valor para o campo Ativo',
        ]);

        $nome = $request->old('nome');
        $ativo = $request->old('ativo');

        try {
            $alunos->empresas_id = auth()->user()->empresas_id;
            $alunos->nome = $request->input('nome');
            $alunos->apelido = $request->input('apelido');
            $alunos->data_nascimento = $request->input('dataNascimento');
            $alunos->data_cadastro = $request->input('dataCadastro');
            $alunos->rg = $request->input('rg');
            $alunos->cpf = $request->input('cpf');
            $alunos->fobias = $request->input('fobias');
            $alunos->alergias = $request->input('alergias');
            $alunos->pcd = $request->input('pcd');
            $alunos->outros_aspectos = $request->input('outrosAspectos');
            $alunos->cep = $request->input('cep');
            $alunos->endereco = $request->input('endereco');
            $alunos->bairro = $request->input('bairro');
            $alunos->numero = $request->input('numero');
            $alunos->complemento = $request->input('complemento');
            $alunos->cidade = $request->input('cidade');
            $alunos->estado = $request->input('estado');
            $alunos->telefone = $request->input('telefone');
            $alunos->celular = $request->input('celular');
            $alunos->email = $request->input('email');
            $alunos->estado_civil = $request->input('estadoCivil');
            $alunos->profissao = $request->input('profissao');
            $alunos->nome_mae = $request->input('nomeMae');
            $alunos->rg_mae = $request->input('rgMae');
            $alunos->cpf_mae = $request->input('cpfMae');
            $alunos->nome_pai = $request->input('nomePai');
            $alunos->rg_pai = $request->input('rgPai');
            $alunos->cpf_pai = $request->input('cpfPai');
            $alunos->ativo = $request->input('ativo');
            $alunos->obs = $request->input('obs');
            $alunos->deletado = 'nao';
            $alunos->auditoria = $this->operacao('Cadastro do aluno');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/alunos'), $imgName);

                $alunos->foto = $imgName;
            }

            $alunos->save();

            $alunos = $this->alunos
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate(30);
            return view(self::PATH . 'alunoShow', ['alunos' => $alunos])
                ->with('msg', 'Sucesso! Aluno cadastrado com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações do aluno: ' . $th->getMessage()]);
        }

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $aluno = $this->alunos->find($id);
        return view(self::PATH . 'alunoEdit', ['aluno' => $aluno, 'listaEstados' => $this->listaEstados()]);
    }

    public function update(Request $request, string $id)
    {
        $alunos = $this->alunos->find($id);

        $request->validate([
            'nome' => 'required|min:3|max:100',
            'ativo' => 'required',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O campo nome deve ter no mínimo três caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 100 caractes',
            'ativo.required' => 'Selecione um valor para o campo Ativo',
        ]);

        $nome = $request->old('nome');
        $ativo = $request->old('ativo');

        try {
            $alunos->nome = $request->input('nome');
            $alunos->apelido = $request->input('apelido');
            $alunos->data_nascimento = $request->input('dataNascimento');
            $alunos->data_cadastro = $request->input('dataCadastro');
            $alunos->rg = $request->input('rg');
            $alunos->cpf = $request->input('cpf');
            $alunos->fobias = $request->input('fobias');
            $alunos->alergias = $request->input('alergias');
            $alunos->pcd = $request->input('pcd');
            $alunos->outros_aspectos = $request->input('outrosAspectos');
            $alunos->cep = $request->input('cep');
            $alunos->endereco = $request->input('endereco');
            $alunos->bairro = $request->input('bairro');
            $alunos->numero = $request->input('numero');
            $alunos->complemento = $request->input('complemento');
            $alunos->cidade = $request->input('cidade');
            $alunos->estado = $request->input('estado');
            $alunos->telefone = $request->input('telefone');
            $alunos->celular = $request->input('celular');
            $alunos->email = $request->input('email');
            $alunos->estado_civil = $request->input('estadoCivil');
            $alunos->profissao = $request->input('profissao');
            $alunos->nome_mae = $request->input('nomeMae');
            $alunos->rg_mae = $request->input('rgMae');
            $alunos->cpf_mae = $request->input('cpfMae');
            $alunos->nome_pai = $request->input('nomePai');
            $alunos->rg_pai = $request->input('rgPai');
            $alunos->cpf_pai = $request->input('cpfPai');
            $alunos->ativo = $request->input('ativo');
            $alunos->obs = $request->input('obs');
            $alunos->deletado = 'nao';
            $alunos->auditoria = $this->operacao('Atualizou as informações do aluno');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/alunos'), $imgName);

                $alunos->foto = $imgName;
            }

            $alunos->save();

            $alunos = $this->alunos
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate(30);
            return view(self::PATH . 'alunoShow', ['alunos' => $alunos])
                ->with('msg', 'Sucesso! As informações do aluno foram atualizadas com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível atualizar as informações do aluno: ' . $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {

        $aluno = $this->alunos->find($id);

        if ($aluno->count() >= 1) {

            try {

                $aluno->deletado = 'sim';
                $aluno->auditoria = $this->operacao('Atualizou as informações do aluno');
                $aluno->save();

                $alunos = $this->alunos
                    ->where('empresas_id', auth()->user()->empresas_id)
                    ->where('deletado', 'nao')
                    ->orderBy('id', 'desc')
                    ->paginate(30);
                return view(self::PATH . 'alunoShow', ['alunos' => $alunos])
                    ->with('msg', 'Sucesso! As informações do aluno foram excluidas com sucesso!');

            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível excluir as informações do aluno: ' . $th->getMessage()]);
            }

        } else {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível localizar o alunos selecionar!']);
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

        $alunos = $this->alunos
            ->where($criterio, 'LIKE', '%' . $pesquisa . '%')
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->paginate();

        return view(self::PATH . 'alunoShow', ['alunos' => $alunos, 'inputs'=>$request->all()]);

    }

    private function listaEstados()
    {
        return $estados = array(
            "Acre" => "AC",
            "Alagoas" => "AL",
            "Amapá" => "AP",
            "Amazonas" => "AM",
            "Bahia" => "BA",
            "Ceará" => "CE",
            "Distrito Federal" => "DF",
            "Espírito Santo" => "ES",
            "Goiás" => "GO",
            "Maranhão" => "MA",
            "Mato Grosso" => "MT",
            "Mato Grosso do Sul" => "MS",
            "Minas Gerais" => "MG",
            "Pará" => "PA",
            "Paraíba" => "PB",
            "Paraná" => "PR",
            "Pernambuco" => "PE",
            "Piauí" => "PI",
            "Rio de Janeiro" => "RJ",
            "Rio Grande do Norte" => "RN",
            "Rio Grande do Sul" => "RS",
            "Rondônia" => "RO",
            "Roraima" => "RR",
            "Santa Catarina" => "SC",
            "São Paulo" => "SP",
            "Sergipe" => "SE",
            "Tocantins" => "TO"
        );
    }

    private function operacao(string $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }

}
