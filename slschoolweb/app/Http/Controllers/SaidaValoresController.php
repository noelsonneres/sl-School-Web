<?php

namespace App\Http\Controllers;

use App\Models\Saidavalor;
use Illuminate\Http\Request;

class SaidaValoresController extends Controller
{

    const PATH = 'screens.saidaValores.';
    private $saidas;

    public function __construct()
    {
        $this->saidas = new Saidavalor();
    }

    public function index()
    {

        $saidas = $this->saidas->paginate();
        return view(self::PATH.'saidaValoresShow');

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
