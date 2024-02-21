<?php

namespace App\Http\Controllers;

use App\Models\FormasPagamento;
use DateTime;
use Illuminate\Http\Request;

class FormasPagamentosController extends Controller
{

    const PATH = 'screens.formaPagamento.';
    private $forma;

    public function __construct()
    {
        $this->forma = new FormasPagamento();
    }

    public function index()
    {

        $formas = $this->forma
            ->where('empresas_id', auth()->user()->empresas_id)
            ->where('deletado', 'nao')
            ->orderBy('id', 'desc')
            ->paginate();

        return view(self::PATH . 'formaPagamentoShow', ['formas' => $formas]);
    }

    public function create()
    {
        return view(self::PATH . 'formaPagamentosCreate');
    }

    public function store(Request $request)
    {

        $forma = $this->forma;

        $request->validate([
            'forma' => 'required|min:2|max:50',
        ], [
            'forma.required' => 'O campo Forma de Pagamentos é obrigatório',
            'forma.min' => 'A Forma de Pagamento deve ter mais de três caracteres',
            'forma.max' => 'A Forma de Pagamento deve ter menos de 50 caracteres',
        ]);

        try {
            $forma->empresas_id = auth()->user()->empresas_id;
            $forma->formas = $request->input('forma');
            $forma->deletado = 'nao';
            $forma->auditoria = $this->operacao('Cadastrou a forma de pagamento');
            $forma->save();

            $formas = $this->forma
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate();

            return view(self::PATH . 'formaPagamentoShow', ['formas' => $formas])
                            ->with('msg', 'Sucesso! Forma de pagamento cadastrada com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar a Forma de pagamentos: ' . $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $forma = $this->forma->find($id);
        return view(self::PATH.'formaPagamentosEdit', ['forma'=>$forma]);
    }

    public function update(Request $request, string $id)
    {

        $forma = $this->forma->find($id);

        $request->validate([
            'forma' => 'required|min:2|max:50',
        ], [
            'forma.required' => 'O campo Forma de Pagamentos é obrigatório',
            'forma.min' => 'A Forma de Pagamento deve ter mais de três caracteres',
            'forma.max' => 'A Forma de Pagamento deve ter menos de 50 caracteres',
        ]);

        try {
            $forma->formas = $request->input('forma');
            $forma->deletado = 'nao';
            $forma->auditoria = $this->operacao('Atualizou a forma de pagamento');
            $forma->save();

            $formas = $this->forma
                ->where('empresas_id', auth()->user()->empresas_id)
                ->where('deletado', 'nao')
                ->orderBy('id', 'desc')
                ->paginate();

            return view(self::PATH . 'formaPagamentoShow', ['formas' => $formas])
                                ->with('msg', 'Sucesso! Forma de pagamento atualizada com sucesso!');;
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()
                                ->withErrors(['ERRO! Não foi possível salvar a Forma de pagamentos: ' . $th->getMessage()]);
        }

    }

    public function destroy(string $id)
    {
        $forma = $this->forma->find($id);
        if($forma != null){

            try {
                
                $forma->deletado = 'sim';
                $forma->auditoria = $this->operacao('Deletou a forma de pagamento');
                $forma->save();
    
                $formas = $this->forma
                    ->where('empresas_id', auth()->user()->empresas_id)
                    ->where('deletado', 'nao')
                    ->orderBy('id', 'desc')
                    ->paginate();
    
                return view(self::PATH . 'formaPagamentoShow', ['formas' => $formas])
                                    ->with('msg', 'Sucesso! Forma de pagamento excluida com sucesso!');                 

            } catch (\Throwable $th) {
                return redirect()->back()->withInput()
                ->withErrors(['ERRO! Não foi possível excluir a Forma de pagamentos: ' . $th->getMessage()]);
            }

        }else{
            return redirect()->back()->withInput()
                                ->withErrors(['ERRO! Não foi possível localizar a forma de pagamento!']);            
        }
    }

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }
}
