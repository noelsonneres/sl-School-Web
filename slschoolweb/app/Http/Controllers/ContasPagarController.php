<?php

namespace App\Http\Controllers;

use App\Models\ContasPagar;
use App\Models\PlanoContas;
use Illuminate\Http\Request;

class ContasPagarController extends Controller
{

    const PATH = 'screens.contasPagar.';
    private $contas;

    public function __construct()
    {
        $this->contas = new ContasPagar();
    }

    public function index()
    {
        $contas = $this->contas->paginate();
        return view(self::PATH.'contasPagarShow', ['contas'=>$contas]);

    }

    public function create()
    {
        $planoContas = PlanoContas::all();
        return view(self::PATH.'planoContasCreate', ['planoContas'=>$planoContas]);
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
