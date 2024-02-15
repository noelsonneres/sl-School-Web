<?php

namespace App\Http\Controllers;

use App\Models\HorariosAula;
use DateTime;
use Illuminate\Http\Request;

class HorariosAulasController extends Controller
{

    const PATH =  'screens.horario.';
    private $horario;

    public function __construct()
    {
        $this->horario = new HorariosAula();
    }

    public function index()
    {
        $horario = $this->horario
            ->where('empresas_id', auth()->user()->empresas_id)
            ->paginate();

        return view(self::PATH . 'horariosShow', ['horarios' => $horario]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $horario = $this->horario;

        $request->validate([
            'entrada' => 'required',
            'saida' => 'required',
        ], [
            'entrada.required' => 'O horário de entrada não pode esta vazio',
            'saida.required' => 'O horário de saida não pode esta vazio',
        ]);

        try {
            $horario->empresas_id = auth()->user()->empresas_id;
            $horario->entrada = $request->input('entrada');
            $horario->saida = $request->input('saida');
            $horario->auditoria = $this->operacao('Cadastrando novo horário');
            $horario->save();

            $horario = $this->horario
                ->where('empresas_id', auth()->user()->empresas_id)
                ->paginate();

            return view(self::PATH . 'horariosShow', ['horarios' => $horario])
                ->with('msg', 'Sucesso! Horário de aula cadatrados com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível cadastrar as Informações do horário de aula: ' . $th->getMessage()]);
        }
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

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
        // return 'O usuário '.auth()->user()->id.'- '.auth()->user()->nome.' realizou a operação de '.$operacao.
        //         ' Data e hora'. new DateTime();
    }
}
