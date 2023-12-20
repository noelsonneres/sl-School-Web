<?php

namespace App\Http\Controllers;

use App\Models\ControleCaixa;
use Illuminate\Http\Request;

class ControleCaixaController extends Controller
{

    const PATH =  'screens.controleCaixa.';
    private $caixa;

    public function __construct()
    {
        $this->caixa = new ControleCaixa();
    }

    public function index()
    {

        $caixa = $this->caixa->count();

        if ($caixa === 0){
            return view(self::PATH.'caixaCreate');
        }else{

            $caixa = $this->caixa->latest()->first();
            dd($caixa);

//            Verificar o status do caixa e decidir qual rota retornar com base no status do caixa

        }

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

    private function calcularMensalidades(string $data){
//        RETORNAR O TOTAL DE MENSALIDADES PAGAS EM UM PERIODO
    }

    private function calcularEntradas(string $data)
    {
//        RETORNAR O TOTAL DE ENTRADAS DE UM PERIODO
    }

    private function calcularSaias(string $data){
//        RETORNAR O TOTAL DE SAIDAS DE UM DETERMINDO PERIODO
    }

    private function ultimoValor(string $data)
    {
//      RETORNAR O VALOR DO ULTIMO CAIXA
    }

}
