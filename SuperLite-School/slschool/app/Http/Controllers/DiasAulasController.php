<?php

namespace App\Http\Controllers;

use App\Models\DiasAula;
use DateTime;
use Illuminate\Http\Request;

class DiasAulasController extends Controller
{

    const PATH = 'screens.diaAula.';
    private $dia;

    public function __construct()
    {
        $this->dia = new DiasAula();
    }

    public function index()
    {
        $dias = $this->dia
            ->where('empresas_id', auth()->user()->empresas_id)
            ->paginate();

        return view(self::PATH . 'diasShow', ['dias' => $dias]);
    }

    public function create()
    {
        return view(self::PATH . 'diasCreate');
    }

    public function store(Request $request)
    {

        $dia = $this->dia;

        $request->validate([
            'dia' => 'required|min:2|max:255',
        ], [
            'dia.required' => 'Você deve informar o dia que esta cadastrando',
            'dia.min' => 'O dia que esta cadastrando deve ter mais de 2 caracteres',
            'dia.max' => 'O dia que esta cadastrando deve ter menos de 255 caracteres',
        ]);

        try {
            $dia->empresas_id = auth()->user()->empresas_id;
            $dia->dia = $request->input('dia');
            $dia->auditoria = $this->operacao('Cadatrou novo Dia Aula');
            $dia->save();

            $dias = $this->dia
                ->where('empresas_id', auth()->user()->empresas_id)
                ->paginate();

            return view(self::PATH . 'diasShow', ['dias' => $dias]);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações do dia desejado: ' . $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $dia = $this->dia->find($id);
        return view(self::PATH.'diasEdit', ['dia'=>$dia]);
    }

    public function update(Request $request, string $id)
    {
        $dia = $this->dia->find($id);

        $request->validate([
            'dia' => 'required|min:2|max:255',
        ], [
            'dia.required' => 'Você deve informar o dia que esta cadastrando',
            'dia.min' => 'O dia que esta cadastrando deve ter mais de 2 caracteres',
            'dia.max' => 'O dia que esta cadastrando deve ter menos de 255 caracteres',
        ]);

        try {
            $dia->empresas_id = auth()->user()->empresas_id;
            $dia->dia = $request->input('dia');
            $dia->auditoria = $this->operacao('Atualizou as info. Dia aula');
            $dia->save();

            $dias = $this->dia
                ->where('empresas_id', auth()->user()->empresas_id)
                ->paginate();

            return view(self::PATH . 'diasShow', ['dias' => $dias]);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações do dia desejado: ' . $th->getMessage()]);
        }
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
