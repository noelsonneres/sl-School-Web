<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculasController extends Controller
{

    const PATH = 'screens.matricula.matricula.';
    private $matricula;

    public function __construct()
    {
        $this->matricula = new Matricula();
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
        $matricula = $this->matricula->where('alunos_id', $id)->paginate();
        return view(self::PATH.'matriculaShow', ['matriculas'=>$matricula]);
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
