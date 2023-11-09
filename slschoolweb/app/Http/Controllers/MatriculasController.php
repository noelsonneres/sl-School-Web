<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Aluno;

class MatriculasController extends Controller
{

    const PATH = 'screens.alunos.matricula.';
    public $matricula;

    public function __construct()
    {
        $this->matricula = new Matricula();
    }

    public function index()
    {
        //
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

    public function homeMatricula(string $idAluno){

        $aluno = Aluno::find($idAluno)->first();

        

        return view(self::PATH.'matriculaHome')
                    ->with('aluno', $aluno);

    }

}
