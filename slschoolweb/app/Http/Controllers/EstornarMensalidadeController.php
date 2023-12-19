<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensalidade;

class EstornarMensalidadeController extends Controller
{

    const PATH = 'screens.estornarMensalidade.';
    private $mensalidade;

    public  function __construct()
    {
        $this->mensalidade = new Mensalidade();
    }

    public  function index()
    {
        $mensalidade = Mensalidade::where('id', '0')->paginate();
        return view(self::PATH.'estornarShow', ['mensalidades'=>$mensalidade]);
    }

    public function localizarMensalidade(Request $request)
    {

        $campo = $request->input('opt');
        $valor = $request->input('find');

        if(empty($campo)){
            $mensalidade = Mensalidade::where('id', '0')->paginate();
            return view(self::PATH.'estornarShow', ['mensalidades'=>$mensalidade])
                                ->with('msg', 'ATENÇÃO! Selecione o criterio de pesquisa!');
        }

        if (empty($valor)){
            $valor = 0;
        }

        $mensalidade = Mensalidade::where($campo, 'LIKE', $valor.'%')
                                    ->where('pago', 'sim')
                                    ->paginate(15);

        return view(self::PATH.'estornarShow', ['mensalidades'=>$mensalidade]);

    }

    public function estornar(string $mensalidade){

        $mensalidade = $this->mensalidade->find($mensalidade);

        $matriculaID = $mensalidade->matriculas_id;

        $msg = '';

        try {

            $mensalidade->valor_pago = $mensalidade->valor_parcela;
            $mensalidade->data_pagamento = null;
            $mensalidade->pago = 'nao';
            $mensalidade->responsavel_pagamento = '';
            $mensalidade->forma_pagamento = '';

            $mensalidade->save();

            $msg = 'Sucesso! Mensalidade estornada com sucesso!';

        }catch (\Throwable $th){
            $msg = 'ERRO! Não foi possível estornar a mensalidade!';
        }

        $mensalidade = Mensalidade::where('matriculas_id', $matriculaID)
            ->where('pago', 'sim')
            ->paginate(15);

        return view(self::PATH.'estornarShow', ['mensalidades'=>$mensalidade])
            ->with('msg', $msg);

    }

}
