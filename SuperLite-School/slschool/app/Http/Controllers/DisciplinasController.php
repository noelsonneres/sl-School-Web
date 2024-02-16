<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;

class DisciplinasController extends Controller
{

    const PATH = 'screens.disciplina.';
    private $disciplina;

    public function __construct()
    {
        $this->disciplina = new Disciplina();
    }

    public function index()
    {
        $disciplinas = $this->disciplina
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->paginate();
        return view(self::PATH . 'disciplinasShow', ['disciplinas' => $disciplinas]);
    }

    public function create()
    {
        return view(self::PATH.'disciplinasCreate');
    }

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
