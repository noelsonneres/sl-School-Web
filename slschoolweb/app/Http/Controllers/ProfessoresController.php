<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessoresController extends Controller
{

    const PAHT = 'screens.professores.';
    public $professores;
    
    public function __construct()
    {
        $this->professores = new Professor();
    }

    public function index()
    {
        
        $professores = $this->professores->paginate();
        return view(self::PAHT.'professoresShow', ['professores'=>$professores]);

    }

    public function create()
    {
        
        return view(self::PAHT.'professoresCreate'); 

    }


    public function store(Request $request)
    {
        // CRIAR O PROCESSO PARA INCLUSÃO DOS PROFESSORES
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
