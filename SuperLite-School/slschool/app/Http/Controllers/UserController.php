<?php

//     Terminar de inserir os campos para inserção,
// Criar os procedimentos para retornar os usuário ativos e relacionados com empresa logada

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    const PATH = 'screens.user.';
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $user = $this->user
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->paginate();

        return view(self::PATH . 'userShow', ['users' => $user]);
    }

    public function create()
    {
        $estados = $this->listaEstados();
        return view(self::PATH . 'userCreate', ['estados' => $estados]);
    }

    public function store(Request $request)
    {

        $usuario = $this->user;

        $request->validate([
            'nome' => 'required|min:3|max:100',
            'nomeUsuario' => 'required|min:3|max:20',
            'senha' => 'required|min:6|max:100',
            'confirmarSenha' => 'required|min:6|max:100',
            'email' => 'required|email|max:100',
            'empresas_id' => 'required',
            'empresas_cnpj' => 'required',
            'foto' => [
                'file',
                'image',
                'max:2048',
                'mimes:jpeg,jpg,png,gif',
            ],
        ], [
            'nome.required' => 'Digite um nome para o funcionário',
            'nome.min' => 'O nome do funcionário deve ter no mínimo três caracteres',
            'nomeUsuario.max' => 'O nome de usuário do funcionário deve ter no máximo 100 caracteres',
            'nomeUsuario.required' => 'Digite um nome de usuário  para o funcionário',
            'nomeUsuario.min' => 'O nome de usuário  do funcionário deve ter no mínimo três caracteres',
            'nomeUsuario.max' => 'O nome de usuário  funcionário deve ter no máximo 20 caracteres',
            'email.required' => 'você deve informar um email para cadastrar um novo usuário',
            'email.email' => 'Digite um e-mail valido',
            'email.max' => 'Este email excede o limite permitido. Por favor use um e-mail menor',
            'senha.required' => 'O campo senha é obrigatório',
            'senha.min' => 'A senha deve ter no mínimo 6 caracteres',
            'senha.max' => 'A senha deve ter no mádimo 100 caracteres',
            'confirmarSenha.required' => 'O campo senha é obrigatório',
            'confirmarSenha.min' => 'A senha deve ter no mínimo 6 caracteres',
            'confirmarSenha.max' => 'A senha deve ter no mádimo 100 caracteres',
            'empresas_id.required' => 'Selecione uma empresa antes de cadastrar o funcionário',
            'empresas_cnpj.required' => 'Selecione uma empresa antes de cadastrar o funionário',
        ]);

        $senha = $request->input('senha');
        $confirmar = $request->input('confirmarSenha');

        $nome = $request->old('nome');
        $nomeUsuario = $request->old('nomeUsuario');
        $email = $request->old('email');

        if ($senha !== $confirmar) {
            $estados = $this->listaEstados();
            return redirect()->back()->withInput()->withErrors(['As senhas não são iguais!']);
            // return view(self::PATH . 'userCreate', ['estados'=>$estados])->with('msgErro','As senhas não são iguais!');
        }

        $password = Hash::make($senha);

        try {

            $usuario->empresas_id = auth()->user()->empresas_id;
            $usuario->empresas_cnpj = auth()->user()->empresas_cnpj;
            $usuario->name = $request->input('nome');
            $usuario->user_name = $request->input('nomeUsuario');
            $usuario->email = $request->input('email');
            $usuario->password = $password;
            $usuario->ativo = $request->input('ativo') ?? 'nao';
            $usuario->root = '0';
            $usuario->data_adminssao = $request->input('dtAdmissao');
            $usuario->data_desligamento = $request->input('dtDesligamento');
            $usuario->cpf = $request->input('cpf');
            $usuario->data_nascimento = $request->input('dtNascimento');
            $usuario->apelido = $request->input('apelido');
            $usuario->telefone = $request->input('telefone');
            $usuario->celular = $request->input('celular');
            $usuario->cep = $request->input('cep');
            $usuario->endereco = $request->input('endereco');
            $usuario->bairro = $request->input('bairro');
            $usuario->complemento = $request->input('complemento');
            $usuario->numero = $request->input('numero');
            $usuario->cidade = $request->input('cidade');
            $usuario->uf = $request->input('estado');
            $usuario->obs = $request->input('obs');
            $usuario->deletado = 'nao';
            $usuario->auditoria = $this->operacao('Inserção de um novo Usuário');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/usuarios'), $imgName);

                $usuario->foto = $imgName;
            }

            $usuario->save();

            $user = $this->user
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->paginate();

            return view(self::PATH . 'userShow', ['users' => $user])->with('msg', 'Usuário cadastrado com sucesso!');
        } catch (\Throwable $th) {
            $estados = $this->listaEstados();
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações do usuário: ' . $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $estados = $this->listaEstados();
        $usuario = $this->user->find($id);
        return view(self::PATH . 'userEdit', ['usuario' => $usuario, 'estados' => $estados]);
    }

    public function update(Request $request, string $id)
    {

        $usuario = $this->user->find($id);

        $request->validate([
            'nome' => 'required|min:3|max:100',
            'nomeUsuario' => 'required|min:3|max:20',
            'email' => 'required|email|max:100',
            'empresas_id' => 'required',
            'empresas_cnpj' => 'required',
            'foto' => [
                'file',
                'image',
                'max:2048',
                'mimes:jpeg,jpg,png,gif',
            ],
        ], [
            'nome.required' => 'Digite um nome para o funcionário',
            'nome.min' => 'O nome do funcionário deve ter no mínimo três caracteres',
            'nomeUsuario.max' => 'O nome de usuário do funcionário deve ter no máximo 100 caracteres',
            'nomeUsuario.required' => 'Digite um nome de usuário  para o funcionário',
            'nomeUsuario.min' => 'O nome de usuário  do funcionário deve ter no mínimo três caracteres',
            'nomeUsuario.max' => 'O nome de usuário  funcionário deve ter no máximo 20 caracteres',
            'email.required' => 'você deve informar um email para cadastrar um novo usuário',
            'email.email' => 'Digite um e-mail valido',
            'email.max' => 'Este email excede o limite permitido. Por favor use um e-mail menor',
            'empresas_id.required' => 'Selecione uma empresa antes de cadastrar o funcionário',
            'empresas_cnpj.required' => 'Selecione uma empresa antes de cadastrar o funionário',
        ]);

        $senha = $request->input('senha');
        $confirmar = $request->input('confirmarSenha');


        if ($senha && $confirmar) {
            if ($senha !== $confirmar) {
                $estados = $this->listaEstados();
                return redirect()->back()->withInput()->withErrors(['As senhas não são iguais!']);
                // return view(self::PATH . 'userCreate', ['estados'=>$estados])->with('msgErro','As senhas não são iguais!');
            }

            $password = Hash::make($senha);
            $usuario->password = $password;
        }

        try {

            $usuario->empresas_id = auth()->user()->empresas_id;
            $usuario->empresas_cnpj = auth()->user()->empresas_cnpj;
            $usuario->name = $request->input('nome');
            $usuario->user_name = $request->input('nomeUsuario');
            $usuario->email = $request->input('email');
            $usuario->ativo = $request->input('ativo') ?? 'nao';
            $usuario->root = '0';
            $usuario->data_adminssao = $request->input('dtAdmissao');
            $usuario->data_desligamento = $request->input('dtDesligamento');
            $usuario->cpf = $request->input('cpf');
            $usuario->data_nascimento = $request->input('dtNascimento');
            $usuario->apelido = $request->input('apelido');
            $usuario->telefone = $request->input('telefone');
            $usuario->celular = $request->input('celular');
            $usuario->cep = $request->input('cep');
            $usuario->endereco = $request->input('endereco');
            $usuario->bairro = $request->input('bairro');
            $usuario->complemento = $request->input('complemento');
            $usuario->numero = $request->input('numero');
            $usuario->cidade = $request->input('cidade');
            $usuario->uf = $request->input('estado');
            $usuario->obs = $request->input('obs');
            $usuario->deletado = 'nao';
            $usuario->auditoria = $this->operacao('Atualizar Info. Usuário');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/usuarios'), $imgName);

                $usuario->foto = $imgName;
            }

            $usuario->save();

            $user = $this->user
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->paginate();

            return view(self::PATH . 'userShow', ['users' => $user])->with('msg', 'Usuário cadastrado com sucesso!');
        } catch (\Throwable $th) {
            $estados = $this->listaEstados();
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações do usuário: ' . $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {

        $usuario = $this->user->find($id);
        $msg = '';

        if ($usuario != null) {
            try {
                $usuario->deletado = 'sim';
                $usuario->ativo = '0';
                $usuario->save();
                $msg = 'Sucesso! Usuário deletado com sucesso!';
            } catch (\Throwable $th) {
                $msg = 'ERRO! Não foi possível deletar o usuário selecionado';
            }
        } else {
            $msg = 'ATENÇÃO! Não foi possível localizar o usuário para exclusão';
        }

        $user = $this->user
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->paginate();
        return view(self::PATH . 'userShow', ['users' => $user])
            ->with('msg', $msg);
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

        $usuarios = $this->user
            ->where($criterio, 'LIKE', '%' . $pesquisa . '%')
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->paginate();

        return view(self::PATH . 'userShow', ['users' => $usuarios, 'inputs'=>$request->all()]);

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
        // return 'O usuário '.auth()->user()->id.'- '.auth()->user()->nome.' realizou a operação de '.$operacao.
        //         ' Data e hora'. new DateTime();
    }
}
