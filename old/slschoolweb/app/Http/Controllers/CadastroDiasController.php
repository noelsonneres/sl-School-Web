<?php

namespace App\Http\Controllers;

use App\Models\CadastroDia;
use App\Models\NivelAcesso;
use Illuminate\Http\Request;

class CadastroDiasController extends Controller
{

    const PATH = 'screens.dias.';

    public $dias;

    public function __construct()
    {
        $this->dias = new CadastroDia();
    }

    public function index()
    {
        $dias = $this->dias->paginate();
        return view(self::PATH . 'diasShow', ['dias' => $dias]);
    }

    public function create()
    {
        return view(self::PATH . 'diasCreate');
    }

    public function store(Request $request)
    {
        $dias = new CadastroDia();

        $request->validate([
            'dia1' => 'required|min:3'
        ]);

        $dia1 = $request->old('dia1');

        try {

            $dias->dia1 = $request->input('dia1');
            $dias->dia2 = $request->input('dia2');

            $dias->save();

            $dias = $dias::paginate();

            return view(self::PATH . 'diasShow', ['dias' => $dias])->with('msg', 'Novo dia incluido com sucesso!!!');
        } catch (\Throwable $th) {
            return back('ERRO! Não foi possível salvar as informações!');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {

        $dias = $this->dias->find($id);

        return view(self::PATH . 'diasEdit', ['dias' => $dias]);
    }

    public function update(Request $request, string $id)
    {

        $dias = $this->dias->find($id);

        $request->validate([
            'dia1' => 'required|min:3'
        ]);

        $dia1 = $request->old('dia1');

        try {

            $dias->dia1 = $request->input('dia1');
            $dias->dia2 = $request->input('dia2');

            $dias->save();

            $dias = $dias::paginate();

            return view(self::PATH . 'diasShow', ['dias' => $dias])->with('msg', 'Informações atualizadas com sucesso!!!');
        } catch (\Throwable $th) {
            return back('ERRO! Não foi possível salvar as informações!');
        }
    }

    public function destroy(string $id)
    {

        $dias = $this->dias->find($id);

        if ($dias) {
            $dias->delete();
            $dias = $this->dias->paginate();
            return view(self::PATH . 'diasShow', ['dias' => $dias])->with('msg', 'O dia foi deletado com sucesso!!!');
        } else {
            $dias = $this->dias->paginate();
            return view(self::PATH . 'diasShow', ['dias' => $dias])->with('msg', 'ERRO! Não foi possível localizar o registro');
        }
    }

    public function find(Request $request)
    {

        $valor = $request->input('find');

        $dias = $this->dias->where('dia1', 'LIKE', $valor . '%')->paginate();

        if ($dias->count() === 0) {
            $dias = $this->dias->where('dia2', 'LIKE', $valor . '%')->paginate();
        }

        return view(self::PATH . 'diasShow', ['dias' => $dias]);
    }

}
