<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Responsavel;
use Illuminate\Http\Request;

class RelatorioResponsaveisController extends Controller
{
    
    const PATH = 'screens.relatorios.responsavel.';
    private $responsavel;

    public function __construct()
    {
        $this->responsavel = new Responsavel();
    }

    public function index(){
        $responsavel = $this->responsavel->paginate();
        return view(self::PATH.'relResponsaveisShow', ['responsaveis'=>$responsavel]);
    }

    public function localizarPorAluno(string $alunoID){
        $responsavel = $this->responsavel->where('alunos_id', $alunoID)->first();
        $empresa = Empresa::first();
        return view(self::PATH.'relResponsavelImpressao', ['responsavel'=>$responsavel, 'empresa'=>$empresa]);
    }

    public function localizar(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'id';
        }

        $responaveis = $this->responsavel::where($field, 'LIKE', $value . '%')->orderBy('id', 'desc')->paginate();
        return view(self::PATH.'relResponsaveisShow', ['responsaveis'=>$responaveis]);      

    }

    public function impressao(string $responsavelID){
        $responsavel = $this->responsavel->find($responsavelID)->first();
        $empresa = Empresa::first();
        return view(self::PATH.'relResponsavelImpressao', ['responsavel'=>$responsavel, 'empresa'=>$empresa]);
    }

}
