<?php

namespace App\Http\Controllers;

use App\Models\MaterialEscolar;
use Illuminate\Http\Request;

class MateriaisEscolaresController extends Controller
{

    const PATH = 'screens.material.';
    private $material;

    public function __construct()
    {
        $this->material = new MaterialEscolar();
    }

    public function index()
    {
        $material = $this->material
                            ->where('empresas_id', auth()->user()->empresas_id)
                            ->where('deletado', 'nao')
                            ->paginate();
        return view(self::PATH.'materialShow', ['materiais'=>$material]);
    }

    public function create()
    {
        return view(self::PATH.'materialCreate');
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
