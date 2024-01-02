<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeiosPagamento;
use App\Models\NivelAcesso;

class MeiosPagamentosController extends Controller
{

    const PATH = 'screens.meiosPagamentos.';
    public $meiosPagamento;

    public function __construct()
    {
        $this->meiosPagamento = new MeiosPagamento();
    }


    public function index()
    {

        if($this->verificarAcesso() == 1){

            $meiosPagamento = $this->meiosPagamento->paginate();
            return view(self::PATH.'meiosPagamentoShow', ['meios'=>$meiosPagamento]);

        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    public function create()
    {
        return view(self::PATH.'meiosPagamentoCreate');
    }

    public function store(Request $request)
    {

        $meios = $this->meiosPagamento;

        $request->validate([
            'meios' => 'required|min:2|max:50',
        ]);

        $pgto = $request->old('meios');

        try {

            $meios->meio_pagamento = $request->input('meios');
            $meios->save();

            $meios = $this->meiosPagamento->paginate();
            return view(self::PATH.'meiosPagamentoShow', ['meios'=>$meios])
                ->with('msg', 'Meio de pagamento adicionado com sucesso!!!');

        } catch (\Throwable $th) {

            $meios = $this->meiosPagamento->paginate();
            return view(self::PATH.'meiosPagamentoShow', ['meios'=>$meios])
                ->with('msg', 'ERRO! Não foi possível adicionar o meio de pagamento');

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {

        $meios = $this->meiosPagamento->find($id);

        if($meios->count() != 0){
            return view(self::PATH.'meiosPagamentosEdit', ['meios'=>$meios]);
        }else{
            return back()->with('msg', 'Registro não localizado');
        }

    }

    public function update(Request $request, string $id)
    {

        $meios = $this->meiosPagamento->find($id);

        $request->validate([
            'meios' => 'required|min:2|max:50',
        ]);

        $pgto = $request->old('meios');

        try {

            $meios->meio_pagamento = $request->input('meios');
            $meios->save();

            $meios = $this->meiosPagamento->paginate();
            return view(self::PATH.'meiosPagamentoShow', ['meios'=>$meios])
                ->with('msg', 'Informações do meios de pagamento atualizadas com sucesso!!!');

        } catch (\Throwable $th) {

            $meios = $this->meiosPagamento->paginate();
            return view(self::PATH.'meiosPagamentoShow', ['meios'=>$meios])
                ->with('msg', 'ERRO! Não foi possível atualizar as informações do meio de pagamento');

        }

    }

    public function destroy(string $id)
    {

        $meios = $this->meiosPagamento->find($id);

        try {
            $meios->delete();
            $meios = $this->meiosPagamento->paginate();
            return view(self::PATH.'meiosPagamentoShow', ['meios'=>$meios])
            ->with('msg', 'Meio de pagamento deletado com sucesso!!!');
        } catch (\Throwable $th) {
            $meios = $this->meiosPagamento->paginate();
            return view(self::PATH.'meiosPagamentoShow', ['meios'=>$meios])
            ->with('msg', 'ERRO! Não foi possível deletar o Meio de pagamento!!!');
        }

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Meios de pagamento')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }


}
