<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        // CONTINUAR DESTA PARTE EM DIANTE

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
