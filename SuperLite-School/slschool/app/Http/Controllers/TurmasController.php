<?php

namespace App\Http\Controllers;

use App\Models\DiasAula;
use App\Models\HorariosAula;
use App\Models\Professor;
use App\Models\SalaAula;
use App\Models\Turma;
use Illuminate\Http\Request;

class TurmasController extends Controller
{

    const PATH = 'screens.turma.';
    private $turma;

    public function __construct()
    {
        $this->turma = new Turma();
    }

    public function index()
    {
        $turmas = $this->turma
                            ->where('empresas_id', auth()->user()->empresas_id)
                            ->where('deletado', 'nao')
                            ->paginate();
        return view(self::PATH.'turmaShow', ['turmas'=>$turmas]);
    }

    public function create()
    {

        $listaDias = DiasAula::where('empresas_id', auth()->user()->empresas_id)->get();
        $listaHorarios = HorariosAula::where('empresas_id', auth()->user()->empresas_id)->get();
        $listaSala = SalaAula::where('empresas_id', auth()->user()->empresas_id)->get();
        $listaProfessor = Professor::where('empresas_id', auth()->user()->empresas_id)
                            ->where('deletado', 'nao')->get();

        return view(self::PATH.'turmaCreate', [
            'listaDias'=>$listaDias,
            'listaHorarios'=>$listaHorarios,
            'listaSala'=>$listaSala,
            'listaProfessores'=>$listaProfessor
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
