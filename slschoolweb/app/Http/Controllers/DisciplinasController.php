<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
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

        $disciplinas = $this->disciplinas->paginate();
        return view(self::PAHT . 'disciplinaShow', ['disciplinas' => $disciplinas]);
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
            return view(self::PAHT . 'disciplinaShow', ['disciplinas' => $disciplinas])
                ->with('msg', 'ERRO! não foi posssível incluir a nova');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
