<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunosController extends Controller
{

    const PATH = 'screens.matricula.aluno.';
    private $alunos;

    public function __construct()
    {
        $this->alunos = new Aluno();
    }

    public function index()
    {
        $alunos = $this->alunos
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->paginate(30);
        return view(self::PATH . 'alunoShow', ['alunos' => $alunos]);
    }

    public function create()
    {
        return view(self::PATH.'alunoCreate');
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
