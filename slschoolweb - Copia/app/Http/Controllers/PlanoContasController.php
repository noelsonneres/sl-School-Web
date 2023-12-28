<?php

namespace App\Http\Controllers;

use App\Models\PlanoContas;
use Illuminate\Http\Request;

class PlanoContasController extends Controller
{

    const PATH = 'screens.planoContas.';
    private $planoContas;

    public function __construct()
    {
        $this->planoContas = new PlanoContas();
    }

    public function index()
    {
        $planoContas = $this->planoContas->paginate();
        return view(self::PATH.'planoContasShow', ['planoContas'=>$planoContas]);
    }

    public function create()
    {
        return view(self::PATH.'planoContasCreate');
    }

    public function store(Request $request)
    {
        $plano = $this->planoContas;

        $request->validate([
            'plano'=>'required|min:2|max:50',
        ],[
            'plano.required'=>'Informe o plano de contas que deseja cadastrar',
                'plano.min'=>'O campo plano de contas deve ter no miníno 2 caracteres',
                'plano.max'=>'O campo plano de contas deve ter no máximo 50 caracteres',
            ]
        );

        $msg = '';

        try {

          $plano->plano = $request->input('plano');
          $plano->save();

          $msg = 'Plano de contas adicionado com sucesso!';

        }catch (\Throwable $th){
            $msg = 'ERRO! Não foi possível adicionar o plano de contas: '.$th->getMessage();
        }

        $planoContas = $this->planoContas->paginate();
        return view(self::PATH.'planoContasShow', ['planoContas'=>$planoContas])
            ->with('msg', $msg);

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {

        $plano = $this->planoContas->find($id);
        return view(self::PATH.'planoContasEdit', ['plano'=>$plano]);

    }

    public function update(Request $request, string $id)
    {

        $plano = $this->planoContas->find($id);

        $request->validate([
            'plano'=>'required|min:2|max:50',
        ],[
                'plano.required'=>'Informe o plano de contas que deseja cadastrar',
                'plano.min'=>'O campo plano de contas deve ter no miníno 2 caracteres',
                'plano.max'=>'O campo plano de contas deve ter no máximo 50 caracteres',
            ]
        );

        $msg = '';

        try {

            $plano->plano = $request->input('plano');
            $plano->save();

            $msg = 'Informações do plano de contas atualizado com sucesso!';

        }catch (\Throwable $th){
            $msg = 'ERRO! Não foi possível atualizar as informações do plano de contas: '.$th->getMessage();
        }

        $planoContas = $this->planoContas->paginate();
        return view(self::PATH.'planoContasShow', ['planoContas'=>$planoContas])
            ->with('msg', $msg);

    }

    public function destroy(string $id)
    {

        $plano = $this->planoContas->find($id);

        $msg = '';

        if ($plano->count() >= 1){

            try {
                $plano->delete();
                $msg = 'Plano de contas excluido com sucesso!';
            }catch (\Throwable $th){
                $msg = 'ERRO! Não foi possível exlcuir o plano de contas: '.$th->getMessage();
            }

        }else{
            $msg = 'ERRO! Não foi possível exlcuir o plano de contas!';
        }

        $planoContas = $this->planoContas->paginate();
        return view(self::PATH.'planoContasShow', ['planoContas'=>$planoContas])
            ->with('msg', $msg);

    }

    public function find(Request $request){

        $value = $request->input('find');

        if(empty($field)){
            $field = 'id';
        }

        $plano = $this->planoContas::where('plano', 'LIKE', $value.'%')->paginate(15);

        return view(self::PATH . 'planoContasShow', ['planoContas' => $plano]);

    }
}
