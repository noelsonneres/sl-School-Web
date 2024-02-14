<?php

namespace App\Http\Controllers;

use App\Models\DiasAula;
use Illuminate\Http\Request;

class DiasAulasController extends Controller
{

    const PATH = 'screens.diaAula.';
    private $dia;

    public function __construct()
    {
        $this->dia = new DiasAula();
    }

    public function index()
    {
        $dias = $this->dia
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('id', '0')
            ->paginate();  
            
        return view(self::PATH.'diasShow', ['dias'=>$dias]);                
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
