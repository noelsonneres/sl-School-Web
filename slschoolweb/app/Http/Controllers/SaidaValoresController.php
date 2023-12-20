<?php

namespace App\Http\Controllers;

use App\Models\Saidavalor;
use Illuminate\Http\Request;

class SaidaValoresController extends Controller
{

    const PATH = 'screens.saidaValores.';
    private $saidas;

    public function __construct()
    {
        $this->saidas = new Saidavalor();
    }

    public function index()
    {

        $saidas = $this->saidas->paginate();
        return view(self::PATH . 'saidaValoresShow', ['saidaValores' => $saidas]);

    }

    public function create()
    {

        return view(self::PATH . 'saidaValoresCreate');

    }

    public function store(Request $request)
    {

        $saida = $this->saidas;

        $request->validate([
            'motivo' => 'required|min:3|max:50',
            'data' => 'required',
            'hora' => 'required',
            'valor' => 'required',
        ], [
            'motivo.required' => 'Informe um valor para o campo Motivo',
            'motivo.min' => 'O motivo da motivo deve ter mais de três caracteres',
            'motivo.max' => 'O motivo da motivo deve ter mens de 50 caracteres',
            'data.required' => 'Selecione uma data valida para a saída',
            'hora.required' => 'Informe um horário valido',
            'valor.required' => 'Digite o valor da saída',
        ]);

        $motivo = $request->old('motivo');
        $data = $request->old('data');
        $hora = $request->old('hora');
        $valor = $request->old('valor');

        $msg = '';

        try {

            if ($this->verificarCaixa() === true) {
                $saida->motivo = $request->input('motivo');
                $saida->data = $request->input('data');
                $saida->hora = $request->input('hora');
                $saida->valor = $request->input('valor');
                $saida->observacao = $request->input('obs');

                $saida->save();

                $msg = 'SUCESSO! Saída efetuada com sucesso!';
            }else{
                $msg = 'ATENÇÃO! Não há saldo suficiente para esta saída!';
            }

        } catch (\Throwable $th) {
            $msg = 'ERRO! Não foi possível realizar a Saída dos valores: ' . $th->getMessage();
        }

        $saidas = $this->saidas->paginate();
        return view(self::PATH . 'saidaValoresShow', ['saidaValores' => $saidas])
            ->with('msg', $msg);
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

        $saida = $this->saidas->find($id);
        $msg = '';

        if ($saida->count() >= 1){

            try {
                $saida->delete();
                $msg = 'SUCESSO! Saída removida com sucesso!';
            }catch (\Throwable $th){
                $msg = 'ERRO! Não foi possível deletar a saida: '.$th->getMessage();
            }

        }else{
            $msg = 'ATENÇÃO! Não foi possível localizar a saída!';
        }

        $saidas = $this->saidas->paginate();
        return view(self::PATH . 'saidaValoresShow', ['saidaValores' => $saidas])
            ->with('msg', $msg);

    }

    public function find(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if(empty($field)){
            $field = 'id';
        }

        $saidas = Saidavalor::where($field, 'LIKE', $value.'%')->orderBy('id', 'desc')->paginate(15);

        return view(self::PATH . 'saidaValoresShow', ['saidaValores' => $saidas]);

    }

    private function verificarCaixa()
    {
        return true;
//        Veirificar se há saldo sufuciente no caixa para o lançamnto da saída
    }

}
