<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultor;

class ConsultoresController extends Controller
{

    const PATH = 'screens.consultores.';
    public $consultores;

    public function __construct()
    {
        $this->consultores = new Consultor();
    }

    public function index()
    {
        
        $consultores = $this->consultores->paginate();

        return view(self::PATH.'consultoresShow', ['consultores'=>$consultores]);

    }

    public function create()
    {
        
        return view(self::PATH.'consultoresCreate');

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
