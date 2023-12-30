<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    const PATH = 'screens.usuarios.';
    private $usuarios;

    public function __construct()
    {
        $this->usuarios = new User();
    }

    public function index()
    {
        
        $usuarios = $this->usuarios->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'usuarioShow', ['usuarios'=>$usuarios]);

    }

    public function create()
    {
        return view(self::PATH.'usuarioCreate');
    }

    public function store(Request $request)
    {
        
        $usuarios = $this->usuarios;

        $request->validate([
            'nome'=>'required|min:3|max:100',
            'usuario'=>'required|min:2|max:20',
            'senha'=>'required|min:6',
            'confirmarSenha'=>'required|min:6',
            'email'=>'required|email',
        ],[
            'nome.required'=>'Digite o nome do usuário que deseja cadatrar',
            'nome.min'=>'O nome do usuário deve ter no mínimo três caracteres',
            'nome.max'=>'O nome do usuário deve ter no máximo 100 caracteres',

            'senha.required'=>'Informe uma senha para este usuário. A senha deve ter mais de 6 caracteres',
            'senha.min'=>'A senha deve ter mais de 6 caracteres',

            'confirmarSenha.required'=>'Informe uma senha para este usuário. A senha deve ter mais de 6 caracteres',
            'confirmarSenha.min'=>'A senha deve ter mais de 6 caracteres',

            'email.required'=>'Você deve informar um e-mail para este usuário',
            'email.email'=>'Você deve informar um e-mail valido',
    
        ]);

        if($request->input('senha') != $request->input('confirmarSenha')){
            return redirect()->back()->with('erro', 'Senha não são iguais!');
        }

        $nome = $request->old('nome');
        $nomeUsuario = $request->old('usuario');
        $email = $request->old('email');

        $senha = Hash::make($request->input('senha'));

        try {
            
            $usuarios->name = $request->input('nome');
            $usuarios->user_name = $request->input('usuario');
            $usuarios->email = $request->input('email');
            $usuarios->password = $senha;
            $usuarios->documento = $request->input('cpf');
            $usuarios->ativo = $request->input('ativo');
            $usuarios->data_admissao = $request->input('admissao');
            $usuarios->data_desligamento = $request->input('desligamento');
            $usuarios->telefone = $request->input('telefone');
            $usuarios->celular = $request->input('celular');
            $usuarios->endereco = $request->input('endereco');
            $usuarios->bairro = $request->input('bairro');
            $usuarios->complemento = $request->input('complemento');
            $usuarios->numero = $request->input('numero');
            $usuarios->cep = $request->input('cep');
            $usuarios->cidade = $request->input('cidade');
            $usuarios->estado = $request->input('estado');
            $usuarios->observacao = $request->input('obs');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/user'), $imgName);

                $usuarios->foto = $imgName;
            }          
            
            $usuarios->save();

            $usuarios = $this->usuarios->orderBy('id', 'desc')->paginate();
            return view(self::PATH.'usuarioShow', ['usuarios'=>$usuarios])
                                    ->with('msg', 'SUCESSO! Usuário cadastrado com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('erro',
                                 'ERRO! Não foi possível salvar as informações do usuário. Verifique os campo de usuários e email. 
                                        Verifique também se o usuário e e-mail não já estão cadastrados');
        }

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        
        $usuario = $this->usuarios->find($id);
        return view(self::PATH.'usuarioEdit', ['usuario'=>$usuario]);

    }

    public function update(Request $request, string $id)
    {

        $usuarios = $this->usuarios->find($id);

        $request->validate([
            'nome'=>'required|min:3|max:100',
            'usuario'=>'required|min:2|max:20',
            'email'=>'required|email',
        ],[
            'nome.required'=>'Digite o nome do usuário que deseja cadatrar',
            'nome.min'=>'O nome do usuário deve ter no mínimo três caracteres',
            'nome.max'=>'O nome do usuário deve ter no máximo 100 caracteres',

            'email.required'=>'Você deve informar um e-mail para este usuário',
            'email.email'=>'Você deve informar um e-mail valido',
    
        ]);

        if($request->input('senha') != null and $request->input('confirmarSenha') != null){

            $request->validate([
                'senha'=>'required|min:6',
                'confirmarSenha'=>'required|min:6',
            ],[
                'senha.required'=>'Informe uma senha para este usuário. A senha deve ter mais de 6 caracteres',
                'senha.min'=>'A senha deve ter mais de 6 caracteres',
        
                'confirmarSenha.required'=>'Informe uma senha para este usuário. A senha deve ter mais de 6 caracteres',
                'confirmarSenha.min'=>'A senha deve ter mais de 6 caracteres',
            ]);
    
            if($request->input('senha') != $request->input('confirmarSenha')){
                return redirect()->back()->with('erro', 'Senha não são iguais!');
            }
    
            $nome = $request->old('nome');
            $nomeUsuario = $request->old('usuario');
            $email = $request->old('email');
    
            $senha = Hash::make($request->input('senha'));    
            
            $usuarios->password = $senha;

        }

        try {
            
            $usuarios->name = $request->input('nome');
            $usuarios->user_name = $request->input('usuario');
            $usuarios->email = $request->input('email');
            $usuarios->documento = $request->input('cpf');
            $usuarios->ativo = $request->input('ativo');
            $usuarios->data_admissao = $request->input('admissao');
            $usuarios->data_desligamento = $request->input('desligamento');
            $usuarios->telefone = $request->input('telefone');
            $usuarios->celular = $request->input('celular');
            $usuarios->endereco = $request->input('endereco');
            $usuarios->bairro = $request->input('bairro');
            $usuarios->complemento = $request->input('complemento');
            $usuarios->numero = $request->input('numero');
            $usuarios->cep = $request->input('cep');
            $usuarios->cidade = $request->input('cidade');
            $usuarios->estado = $request->input('estado');
            $usuarios->observacao = $request->input('obs');

            //upload da foto
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $requestImage = $request->file('foto');
                $extension = $requestImage->getClientOriginalExtension();
                $imgName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/user'), $imgName);

                $usuarios->foto = $imgName;
            }          
            
            $usuarios->save();

            $usuarios = $this->usuarios->orderBy('id', 'desc')->paginate();
            return view(self::PATH.'usuarioShow', ['usuarios'=>$usuarios])
                                    ->with('msg', 'SUCESSO! As informações do usuário foram atualizadas com sucesso!!!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('erro',
                                 'ERRO! Não foi possível atualizar as informações do usuário. Verifique os campo de usuários e email. 
                                        Verifique também se o usuário e e-mail não já estão cadastrados');
        }

    }

    public function destroy(string $id)
    {
        
        $usuario = $this->usuarios->find($id);

        $msg = '';

        if($usuario != null){

            try {
                $usuario->delete();
                $msg = 'SUCESSO! Usuário deletado com sucesso!';
            } catch (\Throwable $th) {
                $msg = 'ERRO! Não foi possível deletar o usuário selecionado!';
            }

        }else{
            $msg = 'ATENÇÃO! Não foi possível localizar o usuário para exclusão!';
        }

        $usuarios = $this->usuarios->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'usuarioShow', ['usuarios'=>$usuarios])
                                ->with('msg', $msg);

    }
}
