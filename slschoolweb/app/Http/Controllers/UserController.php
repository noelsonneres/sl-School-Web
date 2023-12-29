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
        //
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
