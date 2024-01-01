<?php

namespace App\Http\Controllers;

use App\Models\NivelAcesso;
use App\Models\User;
use Illuminate\Http\Request;

class NivelAcessoController extends Controller
{

    const PATH = 'screens.usuarios.acesso.';
    private $nivel;

    public function __construct()
    {
        $this->nivel = new NivelAcesso();

    }

    public function index()
    {
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
       
        dd(auth()->user()->id);

        $nivel = $this->nivel->where('users_id', $id)->paginate();
        $usuario = User::find($id);
        return view(self::PATH . 'usuarioNivelAcesso', ['niveis' => $nivel, 'usuario' => $usuario, 'recursos' => $this->listaRecursos()]);
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

    private function listaRecursos()
    {
        $list = [
            'Cad.Dias',
            'Cad.Horários',
            'Cad.Salas',
            'Meios De pagamento',

        ];

        return $list;
    }

    public function adcionarRegra(Request $request)
    {
        
        $nivel = $this->nivel;

        $request->validate([
            'recurso' => 'required',
        ], [
            'recurso.required' => 'Selecione uma opção para o Nível de acesso do usuário!',
        ]);

        $msg = '';

        if($this->verificar($request->input('userID'), $request->input('recurso')) == 0){

            try {

                $nivel->users_id = $request->input('userID');
                $nivel->recurso = $request->input('recurso');
                $nivel->permitido = 'sim';
                $nivel->save();
    
                $msg = 'SUCESSO! Acesso concedido ao usuário!';
    
            } catch (\Throwable $th) {
                $msg = 'ERRO! Não foi possível conceder acesso a este recurso para o usuário: '.$th->getMessage();
            }            

        }else{
            $msg = 'ATENÇÃO! Este recurso já esta adiconado para este usuário';
        }        

        $nivel = $this->nivel->where('users_id', $request->input('userID'))->paginate();
        $usuario = User::find($request->input('userID'));
        return view(self::PATH . 'usuarioNivelAcesso', ['niveis' => $nivel, 
                                    'usuario' => $usuario, 'recursos' => $this->listaRecursos()])
                                    ->with('msg', $msg);        

    }

    public function verificar(string $userID, string $recurso){

        $acesso = $this->nivel->where('users_id', $userID)->where('recurso', $recurso)->get();

        if($acesso->count() >= 1){
            return 1;
        }else{
            return 0;
        }

    }

}
