<?php

namespace App\Http\Controllers;

use App\Models\EntradaValor;
use Illuminate\Http\Request;

class EntradaValoresController extends Controller
{

    const PATH = 'screens.entradaValores.';
    private $entrada;

    public function __construct()
    {
        $this->entrada =  new EntradaValor();
    }


    public function index()
    {
        $entrada = $this->entrada->paginate();
        return view(self::PATH.'entradaValoresShow', ['entradas'=>$entrada]);
    }

    public function create()
    {
        return view(self::PATH.'entradaValoresCreate');
    }

    public function store(Request $request)
    {

        $entrada = $this->entrada;

        $request->validate([
            'motivo'=>'required|min:3|max:50',
            'data'=>'required',
            'hora'=>'required',
            'valor'=>'required',
        ],[
            'motivo.required'=>'Informe um valor para o campo Motivo',
            'motivo.min'=>'O motivo da motivo deve ter mais de três caracteres',
            'motivo.max'=>'O motivo da motivo deve ter mens de 50 caracteres',
            'data.required'=>'Selecione uma data valida para a entrada',
            'hora.required'=>'Informe um horário valido',
            'valor.required'=>'Digite o valor da entrada',
        ]);

        $motivo = $request->old('motivo');
        $data = $request->old('data');
        $hora = $request->old('hora');
        $valor = $request->old('valor');

        $msg = '';

        try {

            $entrada->motivo = $request->input('motivo');
            $entrada->data = $request->input('data');
            $entrada->hora = $request->input('hora');
            $entrada->valor = $request->input('valor');
            $entrada->observacao = $request->input('obs');

            $entrada->save();

            $msg = 'SUCESSO! Entrada efetuada com sucesso!';

        }catch (\Throwable $th){
            $msg = 'ERRO! Não foi possível realizar a entrada dos valores: '.$th->getMessage();
        }

        $entrada = $this->entrada->paginate();
        return view(self::PATH.'entradaValoresShow', ['entradas'=>$entrada])
                        ->with('msg', $msg);

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

        $entrada = $this->entrada->find($id);

        $msg = '';

        if ($entrada->count() >= 1){

            try {
                $entrada->delete();
                $msg = 'Entrada de valores deletada com sucesso!';
            }catch (\Throwable $th){
                $msg = 'ERRO! Não foi possível deletar a Entrada selecionada!';
            }

        }else{
            $msg = 'ATENÇÃO! Não foi possível localizar a entrada';
        }

        $entrada = $this->entrada->paginate();
        return view(self::PATH.'entradaValoresShow', ['entradas'=>$entrada])
            ->with('msg', $msg);

    }

    public function find(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if(empty($field)){
            $field = 'id';
        }

        $entrada = EntradaValor::where($field, 'LIKE', $value.'%')->orderBy('id', 'desc')->paginate(15);

        return view(self::PATH.'entradaValoresShow', ['entradas'=>$entrada]);

    }

}
