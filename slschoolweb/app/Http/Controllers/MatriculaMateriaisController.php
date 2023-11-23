<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatriculaMaterial;

class MatriculaMateriaisController extends Controller
{

    const PATH = 'screens.alunos.materiais.';
    private $material;

    public function __construct()
    {
        $this->material = new MatriculaMaterial();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        
        return view(self::PATH.'matriculaMateriais');

    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
