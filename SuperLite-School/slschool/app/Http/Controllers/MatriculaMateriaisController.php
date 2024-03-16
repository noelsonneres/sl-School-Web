<?php

namespace App\Http\Controllers;

use App\Models\MaterialEscolar;
use App\Models\Matricula;
use App\Models\MatriculaMaterial;
use Illuminate\Http\Request;

class MatriculaMateriaisController extends Controller
{

    const PATH = 'screens.matricula.material.';
    private $material;

    public function __construct()
    {
        $this->material = new MatriculaMaterial();
    }

    public function index()
    {
        //
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
        $material = $this->material
                            ->where('empresas_id', auth()->user()->empresas_id)
                            ->where('deletado', 'nao')
                            ->where('matriculas_id', $id)
                            ->paginate();
        $matricula = Matricula::find($id);
        return view(self::PATH.'materialShow', ['materiais'=>$material, 'matricula'=>$matricula]);
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

    public function adicionarMaterial(string $matriculaID){
        
        $matricula = Matricula::find($matriculaID);
        $listaMaterial = MaterialEscolar::where('empresas_id', auth()->user()->empresas_id)
                                        ->where('deletado', 'nao')
                                        ->get();
                                        
        return view(self::PATH.'materialCreate', ['matricula'=>$matricula, 'listaMaterial'=>$listaMaterial]);

    }

}
