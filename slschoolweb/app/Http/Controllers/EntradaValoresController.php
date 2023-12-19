<?php

namespace App\Http\Controllers;

use App\Models\EntradaValor;
use Illuminate\Http\Request;

class EntradaValoresController extends Controller
{

    const PAHT = 'screens.entradaValores.';
    private $entrada;

    public function __construct()
    {
        $this->entrada =  new EntradaValor();
    }


    public function index()
    {
        $entrada = $this->entrada->paginate();
        return view(self::PAHT.'entradaValoresShow', ['entradas'=>$entrada]);
    }

    public function create()
    {
        return view(self::PAHT.'entradaValoresCreate');
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
