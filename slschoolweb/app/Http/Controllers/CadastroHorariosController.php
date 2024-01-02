<?php

namespace App\Http\Controllers;

use App\Models\CadastroHorario;
use App\Models\NivelAcesso;
use Illuminate\Http\Request;

class CadastroHorariosController extends Controller
{

    const PATH = 'screens.horarios.';
    public $horarios;

    public function __construct()
    {
        $this->horarios = new CadastroHorario();
    }

    public function index()
    {

        if($this->verificarAcesso() == 1){
            $horarios = $this->horarios->paginate();
            return view(self::PATH . 'horariosShow', ['horarios' => $horarios]);
        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }
    }

    public function create()
    {
        return view(self::PATH . 'horariosCreate');
    }

    public function store(Request $request)
    {

        $horarios = $this->horarios;

        $request->validate([
            'entrada' => 'required',
            'saida' => 'required',
        ]);

        $entrada = $request->old('entrada');

        try {

            $horarios->entrada = $request->input('entrada');
            $horarios->saida = $request->input('saida');

            $horarios->save();
            $horarios = $horarios->paginate();
            return view(self::PATH.'horariosShow', ['horarios'=>$horarios])->with('msg', 'Horário inserido com sucesso!!!');
        } catch (\Throwable $th) {

            $horarios = $horarios->paginate();
            return view(self::PATH . 'horariosShow', ['horarios' => $horarios])->with('msg', 'Não foi possível incluir o novo horário');

        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        
        $horarios = $this->horarios->find($id);

        return view(self::PATH.'horariosEdit', ['horarios'=>$horarios]);

    }

    public function update(Request $request, string $id)
    {

        $horarios = $this->horarios->find($id);

        $request->validate([
            'entrada' => 'required',
            'saida' => 'required',
        ]);

        $entrada = $request->old('entrada');

        try {

            $horarios->entrada = $request->input('entrada');
            $horarios->saida = $request->input('saida');

            $horarios->save();
            $horarios = $horarios->paginate();
            return view(self::PATH.'horariosShow', ['horarios'=>$horarios])
                ->with('msg', 'Informações do horário alteradas com sucesso!!!');
        } catch (\Throwable $th) {

            $horarios = $horarios->paginate();
            return view(self::PATH . 'horariosShow', ['horarios' => $horarios])
                ->with('msg', 'Não foi possível alterar as informações do horário');

        }

    }

    public function destroy(string $id)
    {
        
        $horarios = $this->horarios->find($id);

        if($horarios){
            
            $horarios->delete();
            
            $horarios = $this->horarios->paginate();
            return view(self::PATH . 'horariosShow', ['horarios' => $horarios])
            ->with('msg', 'Horário excluido com sucesso');
        }else{
            $horarios = $this->horarios->paginate();
            return view(self::PATH . 'horariosShow', ['horarios' => $horarios])
            ->with('msg', 'ERRO! Não foi possível excluir o horário!');           
        }

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Cad.Horários')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }    

}
