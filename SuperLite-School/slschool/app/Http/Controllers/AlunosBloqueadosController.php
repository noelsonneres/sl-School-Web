<?php

namespace App\Http\Controllers;

use App\Models\AlunoBloqueado;
use Illuminate\Http\Request;

class AlunosBloqueadosController extends Controller
{

    const PATH = 'screens.alunoBloqueado.';
    private $bloqueados;

    public function __construct()
    {
        $this->bloqueados = new AlunoBloqueado();
    }

    public function index()
    {
        $bloqueados = $this->bloqueados
                            ->where('empresas_id', auth()->user()->empresas_id)
                            ->orderBy('id', 'desc')
                            ->paginate();
        return view(self::PATH.'alunoBloqueadoShow', ['bloqueados'=>$bloqueados]);
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
