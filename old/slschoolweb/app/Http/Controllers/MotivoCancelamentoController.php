<?php

namespace App\Http\Controllers;

use App\Models\MotivoCancelamento;
use App\Models\NivelAcesso;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class MotivoCancelamentoController extends Controller
{

    const PATH = 'screens.motivoCancelamento.';

    private $motivos;

    public function __construct()
    {
        $this->motivos = new MotivoCancelamento();
    }

    public function index()
    {

        if ($this->verificarAcesso() == 1){
            $motivos = $this->motivos->orderBy('id', 'desc')->paginate();
            return view(self::PATH . 'motivoCancelamentoShow', ['motivos' => $motivos]);
        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    public function create()
    {

        return view(self::PATH . 'motivoCancelamentoCreate');
    }

    public function store(Request $request)
    {

        $motivos = $this->motivos;

        $request->validate(
            [
                'motivo' => 'required',
            ],
            [
                'motivo.required' => 'Informe um motivo antes de continuar!',
            ]
        );

        $motivo = $request->old('motivo');

        try {

            $motivos->motivo = $request->input('motivo');

            $motivos->save();

            $motivos = $this->motivos->orderBy('id', 'desc')->paginate();

            return view(self::PATH . 'motivoCancelamentoShow', ['motivos' => $motivos])
                ->with('msg', 'Motivo de cancelamento incluido com sucesso!!!');
        } catch (\Throwable $th) {

            return 'ERRO! Não foi possível salvar as informações no banco de dados: ' . $th;
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {

        $motivo = $this->motivos->find($id);

        return view(self::PATH . 'motivoCancelamentoEdit', ['motivo' => $motivo]);
    }

    public function update(Request $request, string $id)
    {

        $motivos = $this->motivos->find($id);

        $request->validate(
            [
                'motivo' => 'required',
            ],
            [
                'motivo.required' => 'Informe um motivo antes de continuar!',
            ]
        );

        try {

            $motivos->motivo = $request->input('motivo');

            $motivos->save();

            $motivos = $this->motivos->orderBy('id', 'desc')->paginate();

            return view(self::PATH . 'motivoCancelamentoShow', ['motivos' => $motivos])
                ->with('msg', 'Informações atualizadas com sucesso!!!');
        } catch (\Throwable $th) {

            return 'ERRO! Não foi possível atualizar as informações no banco de dados: ' . $th;
        }
    }

    public function destroy(string $id)
    {

        $motivo = $this->motivos->find($id);

        if ($motivo->count() >= 1) {


            try {

                $motivo->delete();

                $motivos = $this->motivos->orderBy('id', 'desc')->paginate();

                return view(self::PATH . 'motivoCancelamentoShow', ['motivos' => $motivos])
                    ->with('msg', 'Motivo removido com sucesso!!!');
            } catch (\Throwable $th) {

                return 'ERRO! Não foi possível remover as informações no banco de dados: ' . $th;
            }
        }
    }

    public function find(Request $request)
    {

        $valor = $request->input('find');

        $motivos = $this->motivos->where('motivo', 'LIKE', '%'. $valor. '%')->paginate();


        return view(self::PATH . 'motivoCancelamentoShow', ['motivos' => $motivos]);

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Motivos de cancelamento')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }


}
