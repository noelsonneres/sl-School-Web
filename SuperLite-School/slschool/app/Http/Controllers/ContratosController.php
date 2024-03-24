<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use DateTime;
use Illuminate\Http\Request;

class ContratosController extends Controller
{

    const PATH = 'screens.contrato.';
    private $contrato;

    public function __construct()
    {
        $this->contrato = new Contrato();
    }

    public function index()
    {
        $contratos =  $this->contrato->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->paginate();
        return view(self::PATH . 'contratoShow', ['contratos' => $contratos]);
    }

    public function create()
    {
        return view(self::PATH . 'contratoCreate');
    }

    public function store(Request $request)
    {
        $contrato = $this->contrato;

        $request->validate([
            'descricao' => 'required|min:3|max:100',
            'contrato' => 'required',
        ], [
            'descricao.required' => 'O campo Descrição é obrigatório',
            'descricao.min' => 'O campo Descrição deve ter no minímo três caracteres',
            'descricao.max' => 'O campo Descrição deve ter no máximo 100 caracteres',
            'contrato.required' => 'Configure o seu contrato',
        ]);

        $descricao = $request->old('descricao');

        try {

            $contrato->empresas_id = auth()->user()->empresas_id;
            $contrato->contrato = $request->input('contrato');
            $contrato->descricao = $request->input('descricao');
            $contrato->deletado = 'nao';
            $contrato->auditoria = $this->operacao('Incluir novo contrato');

            $contrato->save();

            $contratos =  $this->contrato->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->paginate();
            return view(self::PATH . 'contratoShow', ['contratos' => $contratos])
                ->with('msg', 'Sucesso! Contrato incluido com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações do contrato: ' . $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $contrato = $this->contrato->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->where('id', $id)
            ->first();
        return view(self::PATH . 'contratoEdit', ['contrato' => $contrato]);
    }

    public function update(Request $request, string $id)
    {
        $contrato = $this->contrato->find($id);
        $request->validate([
            'descricao' => 'required|min:3|max:100',
            'contrato' => 'required',
        ], [
            'descricao.required' => 'O campo Descrição é obrigatório',
            'descricao.min' => 'O campo Descrição deve ter no minímo três caracteres',
            'descricao.max' => 'O campo Descrição deve ter no máximo 100 caracteres',
            'contrato.required' => 'Configure o seu contrato',
        ]);

        try {

            $contrato->contrato = $request->input('contrato');
            $contrato->descricao = $request->input('descricao');
            $contrato->deletado = 'nao';
            $contrato->auditoria = $this->operacao('Incluir novo contrato');

            $contrato->save();

            $contratos =  $this->contrato->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->paginate();
            return view(self::PATH . 'contratoShow', ['contratos' => $contratos])
                ->with('msg', 'Sucesso! Contrato atualizado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível atualizar as informações do contrato: ' . $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $contrato = $this->contrato->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->where('id', $id)
            ->first();

        if($contrato->count() >= 1){
            try {
                $contrato->deletado = 'sim';
                $contrato->auditoria = $this->operacao('Excluir as informações do contrato');
    
                $contrato->save();
    
                $contratos =  $this->contrato->where('empresas_id', auth()->user()->empresas_id)
                    ->where('deletado', 'nao')
                    ->paginate();
                return view(self::PATH . 'contratoShow', ['contratos' => $contratos])
                    ->with('msg', 'Sucesso! Contrato atualizado com sucesso!');                
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível excluir as informações do contrato: ' . $th->getMessage()]);
            }
        }else{
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível localizar as informações do contrato!']);            
        }           

    }

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }
}
