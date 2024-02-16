<?php

namespace App\Http\Controllers;

use App\Models\SalaAula;
use DateTime;
use Illuminate\Http\Request;

class SalaAulasController extends Controller
{

    const PATH = 'screens.salaAula.';
    private $sala;

    public function __construct()
    {
        $this->sala = new SalaAula();
    }

    public function index()
    {
        $salas = $this->sala
            ->where('empresas_id', auth()->user()->empresas_id)
            ->paginate();

        return view(self::PATH . 'salaAulasShow', ['salas' => $salas]);
    }

    public function create()
    {
        return view(self::PATH . 'salaCreate');
    }

    public function store(Request $request)
    {
        $sala = $this->sala;

        $request->validate([
            'sala' => 'required|min:3|max:100',
            'vagas' => 'numeric|numeric',
            'descricao' => 'required|min:3|max:255',
        ], [
            'sala.required' => 'O campo sala é obrigatório',
            'sala.min' => 'O campo sala deve ter no mínimo 3 caracteres',
            'sala.max' => 'O campo sala deve ter no máximo 100 caracteres',
            'vagas.required' => 'O campo Vagas é obrigatório',
            'vagas.numeric' => 'Digite um valor valido para o campo Vagas',
            'descricao.required' => 'O campo descrição é obrigatório',
            'descricao.min' => 'O campo descrição deve ter no mínimo 3 caracteres',
            'descricao.max' => 'O campo descrição deve ter no máximo 255 caracteres',
        ]);

        $salas = $request->input('sala');
        $vagas = $request->input('vagas');
        $descricao = $request->input('descricao');

        try {
            $sala->empresas_id = auth()->user()->empresas_id;
            $sala->sala = $request->input('sala');
            $sala->vagas = $request->input('vagas');
            $sala->descricao = $request->input('descricao');
            $sala->auditoria = $this->operacao('Cadastrou a sala');
            $sala->save();

            $salas = $this->sala
                ->where('empresas_id', auth()->user()->empresas_id)
                ->paginate();

            return view(self::PATH . 'salaAulasShow', ['salas' => $salas])
                        ->with('msg', 'Sucesso! Sala cadastrado com sucesso');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível inserir as informações da sala no banco de dados: ' . $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $sala = $this->sala->find($id);
        return view(self::PATH.'salaEdit', ['sala'=>$sala]);
    }

    public function update(Request $request, string $id)
    {

        $sala = $this->sala->find($id);

        $request->validate([
            'sala' => 'required|min:3|max:100',
            'vagas' => 'numeric|numeric',
            'descricao' => 'required|min:3|max:255',
        ], [
            'sala.required' => 'O campo sala é obrigatório',
            'sala.min' => 'O campo sala deve ter no mínimo 3 caracteres',
            'sala.max' => 'O campo sala deve ter no máximo 100 caracteres',
            'vagas.required' => 'O campo Vagas é obrigatório',
            'vagas.numeric' => 'Digite um valor valido para o campo Vagas',
            'descricao.required' => 'O campo descrição é obrigatório',
            'descricao.min' => 'O campo descrição deve ter no mínimo 3 caracteres',
            'descricao.max' => 'O campo descrição deve ter no máximo 255 caracteres',
        ]);

        $salas = $request->input('sala');
        $vagas = $request->input('vagas');
        $descricao = $request->input('descricao');

        try {
            $sala->sala = $request->input('sala');
            $sala->vagas = $request->input('vagas');
            $sala->descricao = $request->input('descricao');
            $sala->auditoria = $this->operacao('Atualizou as informações da sala');
            $sala->save();

            $salas = $this->sala
                ->where('empresas_id', auth()->user()->empresas_id)
                ->paginate();

            return view(self::PATH . 'salaAulasShow', ['salas' => $salas])
                        ->with('msg', 'Sucesso! Informações da sala Atualizadas com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível atualizar as informações da sala no banco de dados: ' . $th->getMessage()]);
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
    }
}
