<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Mensalidade;
use Illuminate\Http\Request;

class RelatorioMensalidadesController extends Controller
{

    const PATH = 'screens.relatorios.mensalidade.';
    private $mensalidade;

    public function __construct()
    {
        $this->mensalidade = new Mensalidade();
    }

    public function indexMensalidades()
    {
        $mensalidade = $this->mensalidade->where('matriculas_id', 0)->paginate();
        return view(self::PATH.'relMensalidades', ['mensalidades'=>$mensalidade]);
    }

    //    localizar as mensalidades por nome do alunos, matrícula ou número da parcela
    public function localizar(Request $request)
    {
        
    }

    //    localizar as mensalidades entre datas de vencimento ou pagamento
    public function localizarEntreData(Request $request)
    {

        $request->validate([
            'dt1' => 'required',
            'dt2' => 'required',
            'dtTipo'=>'required',
        ], [
            'dt1.required' => 'Infome uma data valida para o campo "Primeira data',
            'dt2.requied' => 'Infomre uma data valida pra o campo "Segunda data" ',
            'dtTipo.required'=>'Selecione por qual campo deseja selecionar',
        ]);

        $dt1 = $request->input('dt1');
        $dt2 = $request->input('dt2');
        $tipo = $request->input('dtTipo');

        $mensalidades = $this->mensalidade->whereBetween($tipo, [$dt1, $dt2])->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relMensalidades', ['mensalidades'=>$mensalidades]);           

    }

    public function localizarMensalidadesStatus(Request $request)
    {
    }

    public function localizarMensalidadesAvencer(Request $request)
    {

    }

    public function impressao(String $id)
    {
        $mensalidade = $this->mensalidade->find($id);
        $empresa = Empresa::first();
        return view(self::PATH.'relMensalidadesImpressao', ['mensalidade'=>$mensalidade, 'empresa'=>$empresa]);
    }

    public function localizarMensalidadesAtrasadas(Request $request)
    {
    }

    public function filtroAvacado(Request $request)
    {
    }
}
