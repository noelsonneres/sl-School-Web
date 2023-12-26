<?php

namespace App\Http\Controllers;

use App\Models\ConfCarteira;
use App\Models\Empresa;
use App\Models\ImpressaoCarteira;
use Illuminate\Http\Request;
use App\Models\Matricula;

class ImpressaoCarteiraController extends Controller
{

    const PATH = 'screens.carteira.';
    private $carteira;

    public function __construct()
    {
        $this->carteira = new ImpressaoCarteira();
    }

    public function index()
    {
        $carteira = $this->carteira->paginate();
        return view(self::PATH.'carteiraShow', ['carteiras'=>$carteira]);
    }

    public function create()
    {

        $matricula = Matricula::orderBy('id', 'desc')->paginate();
        return view(self::PATH.'carteiraSelecionarAlunos', ['matriculas'=>$matricula]);

    }

    public function store(Request $request)
    {

        $carteira = $this->carteira;

        $request->validate([
           'dtImpressao'=>'required',
            'dtValidade'=>'required',
            'mensagem'=>'required|min:3|max:255',
        ]);

        $matriculaID = $request->input('matriculas');

        try {
          $carteira->matriculas_id = $request->input('matriculas');
          $carteira->alunos_id = $request->input('alunos');
          $carteira->data_impressao = $request->input('dtImpressao');
          $carteira->Validade = $request->input('dtValidade');
          $carteira->mensagem = $request->input('mensagem');
          $carteira->Observacao = $request->input('obs');

          $carteira->save();

            $carteira = $this->carteira->orderBy('id', 'desc')->paginate();
            return view(self::PATH.'carteiraShow', ['carteiras'=>$carteira])
                    ->with('msg', 'SUCESSO! Carteira gerada com sucesso!');

        }catch (\Throwable $th){
            $matricula = Matricula::find($matriculaID);
            $confCarteira = ConfCarteira::all()->first();

            return view(self::PATH.'carteiraConfirmarDados', ['matricula'=>$matricula, 'conf'=>$confCarteira]);
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
    
        $carteira = $this->carteira->find($id);
        $msg = '';

        if($carteira != null){
            
            try {
                $carteira->delete();
                $msg = 'Registro deletado com sucesso!';
            } catch (\Throwable $th) {
                $msg = 'ERRO! Não foi possível deletar o registro selecionado: '.$th->getMessage();
            }

        }else{
            $msg = 'ATENÇÃO! Não foi possível localizar o reistro para exclusão';
        }

        $carteira = $this->carteira->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'carteiraShow', ['carteiras'=>$carteira])
                ->with('msg', $msg);      

    }

    public function confirmarDados(string $matricula)
    {

        $matricula = Matricula::find($matricula);
        $confCarteira = ConfCarteira::all()->first();

        return view(self::PATH.'carteiraConfirmarDados', ['matricula'=>$matricula, 'conf'=>$confCarteira]);

    }

    public function find(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if(empty($field)){
            $field = 'id';
        }

        $matricula = Matricula::where($field, 'LIKE', $value.'%')->paginate(15);
        return view(self::PATH.'carteiraSelecionarAlunos', ['matriculas'=>$matricula]);

    }

    public function impressao(string $carteiraID){

        $carteira = $this->carteira->find($carteiraID);
        $matriculaID = $carteira->matriculas_id;

        $matricula = Matricula::find($matriculaID);
        $empresa = Empresa::all()->first();
        $confCarteira = ConfCarteira::all()->first();       

        return view(self::PATH.'carteiraImpressao', 
                    ['carteiras'=>$carteira, 
                    'matricula'=>$matricula,
                    'empresa'=>$empresa,
                    'confCarteira'=>$confCarteira
                    ]);

    }

}
