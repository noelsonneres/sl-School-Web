<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;
use App\Models\NivelAcesso;

class SalasController extends Controller
{

    const PATH = 'screens.salas.';
    public $salas;

    public function __construct()
    {
        $this->salas = new Sala();
    }

    public function index()
    {
        $salas = $this->salas->paginate();
        return view(self::PATH . 'salasShow', ['salas' => $salas]);
    }

    public function create()
    {

        return view(self::PATH . 'salasCreate');
    }

    public function store(Request $request)
    {

        $salas = $this->salas;

        $request->validate([
            'sala' => 'required|min:3|max:50',
            'vagas' => 'required',
        ]);

        $nomeSala = $request->old('sala');

        try {

            $salas->sala = $request->input('sala');
            $salas->vagas = $request->input('vagas');
            $salas->descricao = $request->input('descricao');

            $salas->save();

            $salas = $this->salas->paginate(15);
            return view(self::PATH . 'salasShow', ['salas' => $salas])->with('msg', 'Sala incluida com sucesso!!!');
        } catch (\Throwable $th) {
            $salas = $this->salas->paginate(15);
            return view(self::PATH . 'salasShow', ['salas' => $salas])->with('msg', 'ERRO! Não foi possível salvar as informações');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {

        $salas = $this->salas->find($id);
        return view(self::PATH . 'salasEdit', ['salas' => $salas]);
    }

    public function update(Request $request, string $id)
    {

        $salas = $this->salas->find($id);

        $request->validate([
            'sala' => 'required|min:3|max:50',
            'vagas' => 'required',
        ]);

        $nomeSala = $request->old('sala');

        try {

            $salas->sala = $request->input('sala');
            $salas->vagas = $request->input('vagas');
            $salas->descricao = $request->input('descricao');

            $salas->save();

            $salas = $this->salas->paginate(15);
            return view(self::PATH . 'salasShow', ['salas' => $salas])
                    ->with('msg', 'Informações da sala alteradas com sucesso!!!');
        } catch (\Throwable $th) {
            $salas = $this->salas->paginate(15);
            return view(self::PATH . 'salasShow', ['salas' => $salas])
                    ->with('msg', 'ERRO! Não foi possível salvar as informações');
        }
    }

    public function destroy(string $id)
    {
        
        $salas = $this->salas->find($id);

        if($salas){

            $salas->delete();

            $salas = $this->salas->paginate();
            return view(self::PATH . 'salasShow', ['salas' => $salas])
            ->with('msg', 'Sala deletada com sucesso!!!');

        }else{
 
            $salas = $this->salas->paginate();
            return view(self::PATH . 'salasShow', ['salas' => $salas])
            ->with('msg', 'Não foi localizar a sala!!');            
            
        }

    }

    public function find(Request $request){

        $field = $request->input('opt');

        $value = $request->input('find');
        $field = $request->input('opt');        

        if(empty($field)){
            $field = 'id';
        }

        $salas = Sala::where($field, 'LIKE', $value.'%')->paginate(15);

        return view(self::PATH . 'salasShow', ['salas' => $salas]);

    }  

}
