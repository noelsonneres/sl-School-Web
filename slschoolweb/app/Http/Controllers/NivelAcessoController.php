<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\NivelAcesso;
use App\Models\User;
use Illuminate\Http\Request;

class NivelAcessoController extends Controller
{

    const PATH = 'screens.usuarios.acesso.';
    private $nivel;

    public function __construct()
    {
        $this->nivel = new NivelAcesso();
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
        //
    }

    public function show(string $id)
    {
    
        $nivel = $this->nivel->where('users_id', $id)->paginate();
        $usuario = User::find($id);
        return view(self::PATH.'usuarioNivelAcesso', ['niveis'=>$nivel, 'usuario'=>$usuario]);

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
