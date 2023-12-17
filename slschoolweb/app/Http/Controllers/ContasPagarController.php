<?php

namespace App\Http\Controllers;

use App\Models\ContasPagar;
use App\Models\PlanoContas;
use Illuminate\Http\Request;

class ContasPagarController extends Controller
{

    const PATH = 'screens.contasPagar.';
    private $contas;

    public function __construct()
    {
        $this->contas = new ContasPagar();
    }

    public function index()
    {
        $contas = $this->contas->paginate();
        return view(self::PATH.'contasPagarShow', ['contas'=>$contas]);

    }

    public function create()
    {
        $planoContas = PlanoContas::all();
        return view(self::PATH.'planoContasCreate', ['planoContas'=>$planoContas]);
    }

    public function store(Request $request)
    {

        $conta = $this->contas;

//        Continuar desta parte em diante

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
