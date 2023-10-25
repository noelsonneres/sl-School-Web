<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    
    const PATH = 'screens.empresa.';
    public $empresa;

    public function __construct()
    {
        $this->empresa = new Empresa();
    }

    public function index()
    {
        
        $empresa = $this->empresa->all();

        if($empresa->count() >= 1){
            return view(self::PATH.'empresaEdit', ['empresa'=>$empresa->first()]);
        }else{
            return view(self::PATH.'empresaCreate');
        }

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
