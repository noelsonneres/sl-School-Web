<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\NivelAcesso;
use Illuminate\Http\Request;

class DisciplinasController extends Controller
{

    const PAHT = 'screens.disciplinas.';
    private $disciplinas;

    public function __construct()
    {
        $this->disciplinas = new Disciplina();
    }

    public function index()
    {

        if($this->verificarAcesso() == 1){
            $disciplinas = $this->disciplinas->paginate();
            return view(self::PAHT . 'disciplinaShow', ['disciplinas' => $disciplinas]);
        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    public function create()
    {

        return view(self::PAHT . 'disciplinasCreate');
    }

    public function store(Request $request)
    {
        $disciplinas = $this->disciplinas;

        $request->validate([
            'disciplinas' => 'required|min:3|max:50',
        ]);

        $disciplina = $request->old('disciplinas');

        try {

            $disciplinas->disciplina = $request->input('disciplinas');
            $disciplinas->descricao = $request->input('descricao');
            $disciplinas->valor = $request->input('valor');
            $disciplinas->duracao_meses = $request->input('duracao');
            $disciplinas->carga_horaria = $request->input('cargaHoraria');
            $disciplinas->observacao = $request->input('obs');

            $disciplinas->save();

            $disciplinas = $this->disciplinas->paginate();
            return view(self::PAHT . 'disciplinaShow', ['disciplinas' => $disciplinas])
                ->with('msg', 'Disciplina incluida com sucesso!!!');

        } catch (\Throwable $th) {

            $disciplinas = $this->disciplinas->paginate();
            return back()->with('msg', 'ERRO! não foi posssível incluir a disciplina');

        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {

        $disciplina = $this->disciplinas->find($id);
        return view(self::PAHT.'disciplinasEdit', ['disciplina'=>$disciplina]);

    }

    public function update(Request $request, string $id)
    {

        $disciplinas = $this->disciplinas->find($id);

        $request->validate([
            'disciplinas' => 'required|min:3|max:50',
        ]);

        $disciplina = $request->old('disciplinas');

        try {

            $disciplinas->disciplina = $request->input('disciplinas');
            $disciplinas->descricao = $request->input('descricao');
            $disciplinas->valor = $request->input('valor');
            $disciplinas->duracao_meses = $request->input('duracao');
            $disciplinas->carga_horaria = $request->input('cargaHoraria');
            $disciplinas->observacao = $request->input('obs');

            $disciplinas->save();

            $disciplinas = $this->disciplinas->paginate();
            return view(self::PAHT . 'disciplinaShow', ['disciplinas' => $disciplinas])
                ->with('msg', 'Dados da disciplina atualizados com sucesso!!!');

        } catch (\Throwable $th) {

            $disciplinas = $this->disciplinas->paginate();
            return back()->with('msg', 'ERRO! não foi posssível atualizar as informações');

        }

    }

    public function destroy(string $id)
    {

        $disciplina = $this->disciplinas->find($id);

        if($disciplina->count() >= 1){

            $disciplina->delete();

            $disciplinas = $this->disciplinas->paginate();
            return view(self::PAHT . 'disciplinaShow', ['disciplinas' => $disciplinas])
                ->with('msg', 'Disciplina excluida com sucesso!!!');

        }else{

            $disciplinas = $this->disciplinas->paginate();
            return view(self::PAHT . 'disciplinaShow', ['disciplinas' => $disciplinas])
                ->with('msg', 'ERRO! Não foi possível excluir a disciplina!!!');

        }

    }

    public function find(Request $request){

        $value = $request->find;
        $disciplinas = Disciplina::where('disciplina', 'LIKE', $value . '%')->paginate();
        return view(self::PAHT . 'disciplinaShow', ['disciplinas' => $disciplinas]);

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Disciplinas')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

}
