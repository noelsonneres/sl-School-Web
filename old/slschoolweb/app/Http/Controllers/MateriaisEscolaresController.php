<?php

namespace App\Http\Controllers;

use App\Models\MateriaisEscolar;
use App\Models\NivelAcesso;
use Illuminate\Http\Request;

class MateriaisEscolaresController extends Controller
{

    const PATH = 'screens.materiasEscolares.';
    private $materiais;

    public function __construct()
    {
        $this->materiais = new MateriaisEscolar();
    }

    public function index()
    {

        if($this->verificarAcesso() == 1){
            $materiais = $this->materiais->orderBy('id', 'desc')->paginate();
            return view(self::PATH . 'materiasEscolaresShow', ['materiais' => $materiais]);
        }else{
            return view('screens/acessoNegado/acessoNegado')->with('msgERRO', 'Recurso bloqueado!');
        }

    }

    public function create()
    {
        return view(self::PATH . 'materiasEscolaresCreate');
    }

    public function store(Request $request)
    {

        $materiais = $this->materiais;

        $request->validate([
            'material' => 'required|min:3|max:255',
        ]);

        try {

            $materiais->material = $request->input('material');
            $materiais->descricao = $request->input('descricao');
            $materiais->valor_un = $request->input('valorUn');
            $materiais->qtde = $request->input('quantidade');
            $materiais->ativo = $request->input('ativo');
            $materiais->obs = $request->input('obs');

            $materiais->save();

            $materiais = $this->materiais->orderBy('id', 'desc')->paginate();
            return view(self::PATH . 'materiasEscolaresShow', ['materiais' => $materiais])
                ->with('msg', 'Material cadastrado com sucesso!!!');
        } catch (\Throwable $th) {

            $materiais = $this->materiais->orderBy('id', 'desc')->paginate();
            return view(self::PATH . 'materiasEscolaresShow', ['materiais' => $materiais])
                ->with('msg', 'ERRO! Não foi possível incluir o novo material!');
        }
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {

        $materiais = $this->materiais->find($id);
        return view(self::PATH . 'materiasEscolaresEdit', ['materiais' => $materiais]);
    }

    public function update(Request $request, string $id)
    {

        if ($id) {

            $materiais = $this->materiais->find($id);

            $request->validate([
                'material' => 'required|min:3|max:255',
            ]);

            try {

                $materiais->material = $request->input('material');
                $materiais->descricao = $request->input('descricao');
                $materiais->valor_un = $request->input('valorUn');
                $materiais->qtde = $request->input('quantidade');
                $materiais->ativo = $request->input('ativo');
                $materiais->obs = $request->input('obs');

                $materiais->save();

                $materiais = $this->materiais->orderBy('id', 'desc')->paginate();
                return view(self::PATH . 'materiasEscolaresShow', ['materiais' => $materiais])
                    ->with('msg', 'Informações o material atualizadas com sucesso!!!');
            } catch (\Throwable $th) {

                $materiais = $this->materiais->orderBy('id', 'desc')->paginate();
                return view(self::PATH . 'materiasEscolaresShow', ['materiais' => $materiais])
                    ->with('msg', 'ERRO! Não foi possível atualizar as informações do material');
            }
        }
    }

    public function destroy(string $id)
    {

        if($id){

            $materiais = $this->materiais->find($id);

            if($materiais->count() >= 1){
                $materiais->delete();

                $materiais = $this->materiais->orderBy('id', 'desc')->paginate();
                return view(self::PATH . 'materiasEscolaresShow', ['materiais' => $materiais])
                    ->with('msg', 'Material escolar removido com sucesso!');

            }else{

                $materiais = $this->materiais->orderBy('id', 'desc')->paginate();
                return view(self::PATH . 'materiasEscolaresShow', ['materiais' => $materiais])
                    ->with('msg', 'ERRO! Não foi possível remove o material informado!');

            }

        }else{
            return back();
        }

    }

    public function find(Request $request){

        $value = $request->input('find');
        $field = $request->input('opt');

        if(empty($field)){
            $field = 'id';
        }

        $materiais = MateriaisEscolar::where($field, 'LIKE', $value.'%')->orderBy('id', 'desc')->paginate(15);

        return view(self::PATH . 'materiasEscolaresShow', ['materiais' => $materiais]);

    }

    private function verificarAcesso()
    {

        $usuario = auth()->user()->id;

        $nivelAcesso = NivelAcesso::where('users_id', $usuario)
            ->where('recurso', 'Materiais escolares')
            ->where('permitido', 'sim')
            ->get();

        if ($nivelAcesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    }

