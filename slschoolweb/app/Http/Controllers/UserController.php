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
        
        $usuarios = $this->usuarios->paginate();
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
            'usuario'=>'required|min:2|max:10',
            'senha'=>'required|min:6|max:50',
            'confirmarSenha'=>'required|min:6|max:50',
            'email'=>'required|email',
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

        } catch (\Throwable $th) {
            //throw $th;
        }

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
}
