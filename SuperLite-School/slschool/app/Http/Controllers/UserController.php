<?php

//     Terminar de inserir os campos para inserção,
// Criar os procedimentos para retornar os usuário ativos e relacionados coma empresa logada

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $user = $this->user->paginate();
        return view(self::PATH . 'userShow', ['users' => $user]);
    }

    public function create()
    {
        $estados = $this->listaEstados();
        return view(self::PATH . 'userCreate', ['estados'=>$estados]);
    }

    public function store(Request $request)
    {
        
        $usuario = $this->user;

        $request->validate([
            'nome'=>'required|min:3|max:100',
            'nomeUsuario'=>'required|min:3|max:20',
            'senha'=>'required|min:6|max:100',
            'confirmarSenha'=>'required|min:6|max:100',
            'email'=>'required|email|max:100',
            'empresas_id'=>'required',
            'empresas_cnpj'=>'required',
        ],[
            'nome.required'=>'Digie um nome para o funcionário',
            'nome.min'=>'O nome do funcionário deve ter no mínimo três caracteres',
            'nomeUsuario.max'=>'O nome de usuário do funcionário deve ter no máximo 100 caracteres',
            'nomeUsuario.required'=>'Digie um nome de usuário  para o funcionário',
            'nomeUsuario.min'=>'O nome de usuário  do funcionário deve ter no mínimo três caracteres',
            'nomeUsuario.max'=>'O nome de usuário  funcionário deve ter no máximo 20 caracteres',
            'senha.required'=>'O campo senha é obrigatório',
            'senha.min'=>'A senha deve ter no mínimo 6 caracteres',
            'senha.max'=>'A senha deve ter no mádimo 100 caracteres',
            'confirmarSenha.required'=>'O campo senha é obrigatório',
            'confirmarSenha.min'=>'A senha deve ter no mínimo 6 caracteres',
            'confirmarSenha.max'=>'A senha deve ter no mádimo 100 caracteres',
            'empresas_id.required'=>'Selecione uma empresa antes de cadastrar o funcionário',
            'empresas_cnpj.required'=>'Selecione uma empresa antes de cadastrar o funionário',
        ]);

        $senha = $request->input('senha');
        $confirmar = $request->input('confirmarSenha');

        $nome = $request->old('nome');

        if($senha !== $confirmar){
            $estados = $this->listaEstados();
            return redirect()->back()->withInput()->withErrors(['As senhas não são iguais!']);
            // return view(self::PATH . 'userCreate', ['estados'=>$estados])->with('msgErro','As senhas não são iguais!');
        }

        try {
            
            $usuario->empresas_id = $request->input('');
            $usuario->empresas_cnpj = $request->input('');
            $usuario->name = $request->input('');
            $usuario->user_name = $request->input('');
            $usuario->email = $request->input('');
            $usuario->password = $request->input('');
            $usuario->ativo = $request->input('');
            $usuario->root = $request->input('');
            $usuario->data_adminssao = $request->input('');
            $usuario->data_desligamento = $request->input('');
            $usuario->cpf = $request->input('');
            $usuario->data_nascimento = $request->input('');
            $usuario->apelido = $request->input('');
            $usuario->telefone = $request->input('');
            $usuario->celular = $request->input('');
            $usuario->cep = $request->input('');
            $usuario->endereco = $request->input('');
            $usuario->bairro = $request->input('');
            $usuario->complemento = $request->input('');
            $usuario->numero = $request->input('');
            $usuario->cidade = $request->input('');
            $usuario->uf = $request->input('');
            $usuario->foto = $request->input('');
            $usuario->obs = $request->input('');
            $usuario->deletado = $request->input('');
            $usuario->auditoria = $this->operacao('Inserção');

        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

    private function operacao(String $operacao){
        return 'O usuário '.auth()->user()->id.'- '.auth()->user()->nome.' realizou a operação de '.$operacao;
    }
}
