<?php

namespace App\Http\Controllers;

use App\Models\ConfCarteira;
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
        $carteira = $this->carteira->where('matriculas_id', '0')->paginate();
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

        dd($request);

//        CONTINUAR DESTA PARTA
//        FAZER O PROCESSO PARA SELECIONAR OS ALUNOS

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

}
