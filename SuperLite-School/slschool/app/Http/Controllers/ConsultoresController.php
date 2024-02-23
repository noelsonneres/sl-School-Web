<?php

namespace App\Http\Controllers;

use App\Models\Consultor;
use Illuminate\Http\Request;

class ConsultoresController extends Controller
{

    const PATH = 'screens.consultor.';
    private $consultor;

    public function __construct()
    {
        $this->consultor = new Consultor();
    }

    public function index()
    {
        $consultor = $this->consultor
                    ->where('empresas_id', auth()->user()->empresas_id)
                    ->where('deletado', 'nao')
                    ->paginate();

        return view(self::PATH.'consultorShow', ['consultores'=>$consultor]);
    }

    public function create()
    {
        return view(self::PATH.'consultorCreate');
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
