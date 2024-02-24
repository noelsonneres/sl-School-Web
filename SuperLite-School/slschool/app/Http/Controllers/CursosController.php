<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class CursosController extends Controller
{

    const PATH = 'screens.curso.';
    private $curso;

    public function __construct()
    {
        $this->curso = new Curso();
    }

    public function index()
    {
        $curso = $this->curso
                        ->where('empresas_id', auth()->user()->empresas_id)
                        ->where('deletado', 'nao')
                        ->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'cursoShow', ['cursos'=>$curso]);
    }

    public function create()
    {
        return view(self::PATH.'cursoCreate');
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
