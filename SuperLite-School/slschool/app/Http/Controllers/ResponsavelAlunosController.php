<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\ResponsavelAluno;
use DateTime;
use Illuminate\Http\Request;

class ResponsavelAlunosController extends Controller
{

    const PATH = 'screens.matricula.responsavel.';
    private $responsavel;

    public function __construct()
    {
        $this->responsavel = new ResponsavelAluno();
    }

    public function index()
    {
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $responsavel = $this->responsavel;

        $request->validate([
            'nome' => 'required|min:3|max:100',
        ], [
            'nome.required' => 'O campo Nome é obrigatório',
            'nome.min' => 'O nome deve ter no mínimo três caracteres',
            'nome.max' => 'O nome deve ter no máximo 100 caracteres',
        ]);

        $nome = $request->input('nome');

        $alunoID = $request->input('aluno');

        try {

            $responsavel->empresas_id = auth()->user()->empresas_id;
            $responsavel->nome = $request->input('nome');
            $responsavel->alunos_id = $request->input('aluno');
            $responsavel->apelido = $request->input('apelido');
            $responsavel->data_nascimento = $request->input('dataNascimento');
            $responsavel->data_cadastro = $request->input('dataCadastro');
            $responsavel->rg = $request->input('rg');
            $responsavel->cpf = $request->input('cpf');
            $responsavel->cep = $request->input('cep');
            $responsavel->endereco = $request->input('endereco');
            $responsavel->bairro = $request->input('bairro');
            $responsavel->numero = $request->input('numero');
            $responsavel->complemento = $request->input('complemento');
            $responsavel->cidade = $request->input('cidade');
            $responsavel->estado = $request->input('estado');
            $responsavel->telefone = $request->input('telefone');
            $responsavel->celular = $request->input('celular');
            $responsavel->email = $request->input('email');
            $responsavel->estado_civil = $request->input('estadoCivil');
            $responsavel->profissao = $request->input('profissao');
            $responsavel->obs = $request->input('obs');
            $responsavel->deletado = 'nao';
            $responsavel->auditoria = $this->operacao('Cadastrou o Responsável');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/responsaveis'), $imgName);

                $responsavel->foto = $imgName;
            }

            $responsavel->save();

            $responsavel = $this->responsavel
            ->where('alunos_id', $alunoID)
            ->where('deletado', 'nao')
            ->where('empresas_id', auth()->user()->empresas_id)
            ->orderBy('id', 'desc')
            ->paginate();

        $aluno = Aluno::find($alunoID);

        return view(self::PATH . 'responsavelShow', ['responsaveis' => $responsavel, 'aluno' => $aluno])
                                    ->with('msg', 'Responsável cadastrada com sucesso!');            

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações do Responsável: ' . $th->getMessage()]);
        }
    }

    public function show(string $id)
    {

        $responsavel = $this->responsavel
            ->where('alunos_id', $id)
            ->where('deletado', 'nao')
            ->where('empresas_id', auth()->user()->empresas_id)
            ->orderBy('id', 'desc')
            ->paginate();

        $aluno = Aluno::find($id);

        return view(self::PATH . 'responsavelShow', ['responsaveis' => $responsavel, 'aluno' => $aluno]);
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

    public function novoResponsavel(string $alunoID)
    {
        return view(self::PATH . 'responsavelCreate', ['alunoID' => $alunoID, 'listaEstado' => $this->listaEstados()]);
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

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }
}
