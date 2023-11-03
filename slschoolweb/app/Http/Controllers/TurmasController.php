<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\CadastroDia;
use App\Models\CadastroHorario;
use App\Models\Professor;
use App\Models\Sala;

class TurmasController extends Controller
{

    const PAHT =  'screens.turmas.';
    private $turmas;

    public function __construct()
    {
        $this->turmas = new Turma();
    }

    public function index()
    {
        
        $turmas = $this->turmas->paginate();
        return view(self::PAHT.'turmasShow', ['turmas'=>$turmas]);

    }

    public function create()
    {
        
        $dias = CadastroDia::all();
        $horarios = CadastroHorario::all();
        $sala = Sala::all();
        $professor = Professor::all();

        return view(self::PAHT.'turmasCreate')
                    ->with('dias', $dias)
                    ->with('horarios', $horarios)
                    ->with('salas', $sala)
                    ->with('professores', $professor);

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
