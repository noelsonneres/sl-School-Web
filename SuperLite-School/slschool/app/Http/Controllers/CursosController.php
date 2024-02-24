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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}
