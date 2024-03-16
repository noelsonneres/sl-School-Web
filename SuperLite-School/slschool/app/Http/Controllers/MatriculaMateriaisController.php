<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\MatriculaMaterial;
use Illuminate\Http\Request;

class MatriculaMateriaisController extends Controller
{

    const PATH = 'screens.matricula.material.';
    private $material;

    public function __construct()
    {
        $this->material = new MatriculaMaterial();
    }

    public function index()
    {
        //
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
        $material = $this->material
                            ->where('empresas_id', auth()->user()->empresas_id)
                            ->where('deletado', 'nao')
                            ->where('matrícula_id', $id);
        $matricula = Matricula::find($id);
        return view(self::PATH.'materialShow', ['materiais'=>$material, 'matricula'=>$matricula]);
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
