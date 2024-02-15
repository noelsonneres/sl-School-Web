<?php

namespace App\Http\Controllers;

use App\Models\SalaAula;
use Illuminate\Http\Request;

class SalaAulasController extends Controller
{

    const PATH = 'screens.salaAula.';
    private $sala;

    public function __construct()
    {
        $this->sala = new SalaAula();
    }

    public function index()
    {
        $salas = $this->sala
                    ->where('empresas_id', auth()->user()->empresas_id)
                    ->paginate();

        return view(self::PATH.'salaAulasShow', ['salas'=>$salas]);
    }

    public function create()
    {
        return view(self::PATH. 'salaCreate');
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
