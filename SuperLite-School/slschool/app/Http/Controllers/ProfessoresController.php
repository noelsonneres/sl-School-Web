<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use DateTime;
use Illuminate\Http\Request;

class ProfessoresController extends Controller
{

    const PATH = 'screens.professor.';
    private $professor;

    public function __construct()
    {
        $this->professor = new Professor();
    }

    public function index()
    {

        $professores = $this->professor
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')
            ->paginate();

        return view(self::PATH . 'professorShow', ['professores' => $professores]);
    }

    public function create()
    {
        return view(self::PATH . 'professorCreate', ['estados' => $this->listaEstados()]);
    }

    public function store(Request $request)
    {
        $professor = $this->professor;

        $request->validate([
            'nome' => 'required|min:3|max:100',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O campo nome deve ter no mínimo três caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 100 caracteres',
        ]);

        $nome = $request->old('nome');

        try {

            $professor->empresas_id = auth()->user()->empresas_id;
            $professor->nome = $request->input('nome');
            $professor->data_nascimento = $request->input('dataNascimento');
            $professor->data_cadastro = $request->input('dataCadastro');
            $professor->cpf = $request->input('cpf');
            $professor->telefone = $request->input('telefone');
            $professor->celular = $request->input('celular');
            $professor->email = $request->input('email');
            $professor->cep = $request->input('cep');
            $professor->endereco = $request->input('endereco');
            $professor->bairro = $request->input('bairro');
            $professor->numero = $request->input('numero');
            $professor->complemento = $request->input('complemento');
            $professor->cidade = $request->input('cidade');
            $professor->estado = $request->input('estado');
            $professor->obs = $request->input('obs');
            $professor->deletado = 'nao';
            $professor->auditoria = $this->operacao('Cadastrou o professor');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/professores'), $imgName);

                $professor->foto = $imgName;
            }

            $professor->save();

            $professores = $this->professor
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate();

            return view(self::PATH . 'professorShow', ['professores' => $professores])
                ->with('msg', 'Sucesso! Professor cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível salvar as informações do professor: ' . $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $professor = $this->professor->find($id);
        return view(self::PATH . 'professorEdit', ['professor' => $professor, 'estados' => $this->listaEstados()]);
    }

    public function update(Request $request, string $id)
    {
        $professor = $this->professor->find($id);

        $request->validate([
            'nome' => 'required|min:3|max:100',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O campo nome deve ter no mínimo três caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 100 caracteres',
        ]);

        $nome = $request->old('nome');

        try {

            $professor->nome = $request->input('nome');
            $professor->data_nascimento = $request->input('dataNascimento');
            $professor->data_cadastro = $request->input('dataCadastro');
            $professor->cpf = $request->input('cpf');
            $professor->telefone = $request->input('telefone');
            $professor->celular = $request->input('celular');
            $professor->email = $request->input('email');
            $professor->cep = $request->input('cep');
            $professor->endereco = $request->input('endereco');
            $professor->bairro = $request->input('bairro');
            $professor->numero = $request->input('numero');
            $professor->complemento = $request->input('complemento');
            $professor->cidade = $request->input('cidade');
            $professor->estado = $request->input('estado');
            $professor->obs = $request->input('obs');
            $professor->deletado = 'nao';
            $professor->auditoria = $this->operacao('Atualizou as informações do professor');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/professores'), $imgName);

                $professor->foto = $imgName;
            }

            $professor->save();

            $professores = $this->professor
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate();

            return view(self::PATH . 'professorShow', ['professores' => $professores])
                ->with('msg', 'Sucesso! As informções do professor foram atualizadas com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível atualizar as informações do professor: ' . $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $professor = $this->professor->find($id);

        if ($professor != null) {

            try {
                $professor->deletado = 'sim';
                $professor->auditoria = $this->operacao('Exclusão das informações do professor');
                $professor->save();

                $professores = $this->professor
                    ->where('empresas_id', auth()->user()->empresas_id)
                    ->where('deletado', 'nao')
                    ->orderBy('id', 'desc')
                    ->paginate();

                return view(self::PATH . 'professorShow', ['professores' => $professores])
                    ->with('msg', 'Sucesso! As informções do professor foram excluidas com sucesso!');

            } catch (\Throwable $th) {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível excluir as informações do professor!']);
            }
        } else {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível excluir as informações do professor!']);
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

        $professores = $this->professor
            ->where($criterio, 'LIKE', '%' . $pesquisa . '%')
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')
            ->paginate();

        return view(self::PATH . 'professorShow', ['professores' => $professores, 'inputs' => $request->all()]);
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
