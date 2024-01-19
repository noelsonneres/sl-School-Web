<?php

namespace App\Http\Controllers;

use App\Models\AlunoBloqueado;
use App\Models\Matricula;
use Illuminate\Http\Request;

class AlunosBloqueadosController extends Controller
{

    const PATH = 'screens.alunos.bloqueados.';
    private $bloqueados;

    public function __construct()
    {
        $this->bloqueados = new AlunoBloqueado();
    }

    public function index()
    {

        $bloqueados = $this->bloqueados->paginate();
        return view(self::PATH . 'alunosBloqueadosShow', ['bloqueados' => $bloqueados]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $bloqueados = $this->bloqueados;

        $request->validate(
            [
                'data' => 'required',
                'hora' => 'required',
                'motivo' => 'required|min:3|max:50',
            ],
            [
                'data.required'=>'Informe uma data valida',
                'hora.required'=>'Informe um horário valido',
                'motivo.required'=>'informe o motivo do bloqueio',
                'motivo.min'=>'O motivo do bloqueio deve ter no minímo três caracteres',
                'motivo.max'=>'O motivo do bloqueio deve ter no máximo 50 caracteres',
            ]
        );
    }

    public function show(string $id)
    {

        $matriculaInfo = Matricula::find($id);

        if ($matriculaInfo->status == 'ativa') {
            return view(self::PATH . 'bloquearAluno', ['matricula' => $matriculaInfo]);
        } else if (($matriculaInfo->status == 'bloqueado')) {
            // alunoBloqueadoInfo
        }
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
}
