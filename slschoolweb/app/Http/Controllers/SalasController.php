<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;

class SalasController extends Controller
{

    const PATH = 'screens.salas.';
    public $salas;

    public function __construct()
    {
        $this->salas = new Sala();
    }

    public function index()
    {
        
        $salas = $this->salas->paginate();
        return view(self::PATH.'salasShow', ['salas'=>$salas]);

    }

    public function create()
    {
        
        return view(self::PATH.'salasCreate');

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
