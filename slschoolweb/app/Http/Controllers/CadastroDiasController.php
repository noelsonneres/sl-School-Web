<?php

namespace App\Http\Controllers;

use App\Models\CadastroDia;
use App\Models\CadastroDias;
use Illuminate\Http\Request;

class CadastroDiasController extends Controller
{

        const PATH = 'screens.dias.';

        public $dias;

        public function __construct(){
            $this->dias = new CadastroDia();
        }

    public function index()
    {
        $dias = $this->dias->paginate();
        return view(self::PATH.'diasShow', ['dias'=>$dias]);
    }

    public function create()
    {
        return view(self::PATH.'diasCreate');
    }

    public function store(Request $request)
    {
        $dias = new CadastroDia();

        $request->validate([
            'dia1'=>'required|min:3'
        ]);

        try {

            $dias->dia1 = $request->input('dia1');
            $dias->dia2 = $request->input('dia2');

            $dias->save();

            $dias = $dias::paginate();

            return view(self::PATH.'diasShow', ['dias'=>$dias])->with('msg', 'Novo dia incluido com sucesso!!!');

        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    public function show(CadastroDias $cadastroDias)
    {
        //
    }

    public function edit(CadastroDias $cadastroDias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CadastroDias $cadastroDias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CadastroDias $cadastroDias)
    {
        //
    }
}
