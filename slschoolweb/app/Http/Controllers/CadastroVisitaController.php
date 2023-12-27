<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CadastroVisita;

class CadastroVisitaController extends Controller
{

    const PATH = 'screens.visitas.';
    private $visitas;

    public function __construct()
    {
        $this->visitas = new CadastroVisita();
    }

    public function index()
    {
        $visitas = $this->visitas->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'visitasShow', ['visitas'=>$visitas]);
    }

    public function create()
    {
        return view(self::PATH.'visitasCreate');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
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
