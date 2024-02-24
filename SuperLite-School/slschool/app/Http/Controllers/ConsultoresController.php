<?php

namespace App\Http\Controllers;

use App\Models\Consultor;
use DateTime;
use Illuminate\Http\Request;

class ConsultoresController extends Controller
{

    const PATH = 'screens.consultor.';
    private $consultor;

    public function __construct()
    {
        $this->consultor = new Consultor();
    }

    public function index()
    {
        $consultor = $this->consultor
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')
            ->paginate();

        return view(self::PATH . 'consultorShow', ['consultores' => $consultor]);
    }

    public function create()
    {
        return view(self::PATH . 'consultorCreate', ['estados' => $this->listaEstados()]);
    }

    public function store(Request $request)
    {
        $consultor = $this->consultor;

        $request->validate([
            'nome' => 'required|min:3|max:100',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O nome deve ser maior que três caracteres',
            'nome.max' => 'O campo nome não pode ser maior que 100 caracteres',
        ]);

        $nome = $request->old('nome');

        try {

            $consultor->empresas_id = auth()->user()->empresas_id;
            $consultor->nome = $request->input('nome');
            $consultor->data_nascimento = $request->input('dataNascimento');
            $consultor->data_cadastro = $request->input('dataCadastro');
            $consultor->cpf = $request->input('cpf');
            $consultor->telefone = $request->input('telefone');
            $consultor->celular = $request->input('celular');
            $consultor->cep = $request->input('cep');
            $consultor->endereco = $request->input('endereco');
            $consultor->bairro = $request->input('bairro');
            $consultor->numero = $request->input('numero');
            $consultor->complemento = $request->input('complemento');
            $consultor->cidade = $request->input('cidade');
            $consultor->estado = $request->input('estado');
            $consultor->obs = $request->input('obs');
            $consultor->deletado = 'nao';
            $consultor->auditoria = $this->operacao('Cadastro do consultor');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/consultor'), $imgName);

                $consultor->foto = $imgName;
            }

            $consultor->save();

            $consultor = $this->consultor
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate();

            return view(self::PATH . 'consultorShow', ['consultores' => $consultor])
                ->with('msg', 'Sucesso! Consultor cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações do consultor: ' . $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $consultor = $this->consultor->find($id);
        return view(self::PATH . 'consultorEdit', ['consultor' => $consultor, 'estados' => $this->listaEstados()]);
    }

    public function update(Request $request, string $id)
    {
        $consultor = $this->consultor->find($id);

        $request->validate([
            'nome' => 'required|min:3|max:100',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O nome deve ser maior que três caracteres',
            'nome.max' => 'O campo nome não pode ser maior que 100 caracteres',
        ]);

        $nome = $request->old('nome');

        try {

            $consultor->nome = $request->input('nome');
            $consultor->data_nascimento = $request->input('dataNascimento');
            $consultor->data_cadastro = $request->input('dataCadastro');
            $consultor->cpf = $request->input('cpf');
            $consultor->telefone = $request->input('telefone');
            $consultor->celular = $request->input('celular');
            $consultor->cep = $request->input('cep');
            $consultor->endereco = $request->input('endereco');
            $consultor->bairro = $request->input('bairro');
            $consultor->numero = $request->input('numero');
            $consultor->complemento = $request->input('complemento');
            $consultor->cidade = $request->input('cidade');
            $consultor->estado = $request->input('estado');
            $consultor->obs = $request->input('obs');
            $consultor->deletado = 'nao';
            $consultor->auditoria = $this->operacao('Atualização das informações do Consultor');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/consultor'), $imgName);

                $consultor->foto = $imgName;
            }

            $consultor->save();

            $consultor = $this->consultor
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate();

            return view(self::PATH . 'consultorShow', ['consultores' => $consultor])
                ->with('msg', 'Sucesso! Informações do Consultor atualizadas com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível atualizar as informações do consultor: ' . $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $consultor = $this->consultor->find($id);

        if ($consultor->count() >= 1) {

            try {

                $consultor->deletado = 'sim';
                $consultor->auditoria = $this->operacao('Consultor marcado como deletado');
                $consultor->save();

                $consultor = $this->consultor
                    ->where('empresas_id', auth()->user()->empresas_id)
                    ->where('deletado', 'nao')
                    ->orderBy('id', 'desc')
                    ->paginate();

                return view(self::PATH . 'consultorShow', ['consultores' => $consultor])
                    ->with('msg', 'Sucesso! Informações do Consultor excluida com sucesso!');
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()
                    ->withErrors(['ERRO! Não foi possível deletar as informações do consultor: ' . $th->getMessage()]);
            }
        } else {
            return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível localizar o Consultor selecionado!']);
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

        $consultores = $this->consultor
            ->where($criterio, 'LIKE', '%' . $pesquisa . '%')
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')
            ->paginate();

        return view(self::PATH . 'consultorShow', ['consultores' => $consultores, 'inputs' => $request->all()]);
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
