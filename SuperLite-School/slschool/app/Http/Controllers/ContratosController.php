<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratosController extends Controller
{

    const PATH = 'screens.contrato.';
    private $contrato;

    public function __construct()
    {
        $this->contrato = new Contrato();
    }

    public function index()
    {
        $contratos =  $this->contrato->where('empresas_id', auth()->user()->empresas_id)
                                        ->where('deletado', 'nao')
                                        ->paginate();
        return view(self::PATH.'contratoShow', ['contratos'=>$contratos]);
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
