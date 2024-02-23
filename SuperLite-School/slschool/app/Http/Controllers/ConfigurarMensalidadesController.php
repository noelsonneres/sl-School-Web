<?php

namespace App\Http\Controllers;

use App\Models\ConfigurarMensalidade;
use DateTime;
use Illuminate\Http\Request;

class ConfigurarMensalidadesController extends Controller
{

    const PATH = 'screens.configurarMensalidades.';
    private $configurar;

    public function __construct()
    {
        $this->configurar = new ConfigurarMensalidade();                
    }
    public function index()
    {
        $configurar = $this->configurar->paginate();
        return view(self::PATH.'configurarMensalidadeShow', ['configurar'=>$configurar]);
    }

    public function create()
    {
        $configurar = $this->configurar->all();

        if($configurar->count() >= 1){
         return view(self::PATH.'configurarMensalidadeEdit', ['configurar'=>$configurar->first()]);
        }else{
            return view(self::PATH.'configurarMensalidadeCreate');
        }
    }

    public function store(Request $request)
    {
        
        $configurar = $this->configurar;

        $request->validate([
            'juros'=>'required|numeric',
            'multa'=>'required|numeric'
        ]);

        $juros = $request->input('juros');
        $multa = $request->input('multa');

        try {
            $configurar->juros = $request->input('juros');
            $configurar->multa = $request->input('multa');
            $configurar->mensagem = $request->input('mensagem');
            $configurar->auditoria = $this->operacao('Adicionar configuração das mensalidades');
            $configurar->save();
            
            $configurar = $this->configurar->paginate();
            return view(self::PATH.'configurarMensalidadeShow', ['configurar'=>$configurar])
                            ->with('msg', 'Sucesso! Informações sobre a Configuração das Mensalidades inseridas com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível salvar as informações da configuração: ' . $th->getMessage()]);
        }

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $configurar = $this->configurar->all();
        return view(self::PATH.'configurarMensalidadeEdit', ['configurar'=>$configurar->first()]);
    }

    public function update(Request $request, string $id)
    {
   
        $configurar = $this->configurar->find($id);

        $request->validate([
            'juros'=>'required|numeric',
            'multa'=>'required|numeric'
        ]);

        $juros = $request->input('juros');
        $multa = $request->input('multa');

        try {
            $configurar->empresas_id = auth()->user()->empresas_id;
            $configurar->juros = $request->input('juros');
            $configurar->multa = $request->input('multa');
            $configurar->mensagem = $request->input('mensagem');
            $configurar->auditoria = $this->operacao('atualizou as configurações das mensalidades');
            $configurar->save();
            
            $configurar = $this->configurar->paginate();
            return view(self::PATH.'configurarMensalidadeShow', ['configurar'=>$configurar])
                    ->with('msg', 'Sucesso! Informações da Configuração de Mensalidade atualizadas com sucesso!');

        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível atualizar as informações da configuração: ' . $th->getMessage()]);
        }

    }

    public function destroy(string $id)
    {
        $configurar = $this->configurar->find($id);

        if($configurar->count() >= 1){

            try {
                $configurar->delete();
                $configurar = $this->configurar->paginate();
                return view(self::PATH.'configurarMensalidadeShow', ['configurar'=>$configurar])
                        ->with('msg', 'Sucesso! As informações da configuração foram excluidas com sucesso!');                
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível excluir as informações da configuação!']); 
            }

        }else{
            return redirect()->back()->withInput()->withErrors(['ERRO! Não foi possível localizar as informações do aluno!']); 
        }

    }

    private function operacao(String $operacao)
    {
        return 'O usuário ' . auth()->user()->id . ' - ' .
            auth()->user()->nome . ' realizou a operação de ' .
            $operacao . ' Data e hora: ' . (new DateTime())->format('Y-m-d H:i:s');
    }    

}
