<?php

namespace App\Http\Controllers;

use App\Models\MatriculaTurma;
use Illuminate\Http\Request;

class MatriculaTurmaController extends Controller
{

    const PATH = 'screens.alunos.turma.';
    private $turmas;

    public function __constructor(){
      $this->turmas = new MatriculaTurma();
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


    public function show(string $id)
    {
        return view(self::PATH.'matriculaTurmaShow');
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
