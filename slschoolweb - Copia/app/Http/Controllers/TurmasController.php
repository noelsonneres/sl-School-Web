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

    const PATH =  'screens.turmas.';
    private $turmas;

    public function __construct()
    {
        $this->turmas = new Turma();
    }

    public function index()
    {
        
        $turmas = $this->turmas->with(['cadastroDias', 'cadastroHorarios'])->paginate(15);
        return view(self::PATH.'turmasShow', ['turmas'=>$turmas]);

    }

    public function create()
    {
        
        $dias = CadastroDia::all();
        $horarios = CadastroHorario::all();
        $sala = Sala::all();
        $professor = Professor::all();

        return view(self::PATH.'turmasCreate')
                    ->with('dias', $dias)
                    ->with('horarios', $horarios)
                    ->with('salas', $sala)
                    ->with('professores', $professor);

    }


    public function store(Request $request)
    {
        
        $turmas = $this->turmas;

        $request->validate([
            'turma' => 'required|min:3|max:100',
            'dias' => 'required',
            'horarios' => 'required',
            'sala' => 'required',
            'turno' => 'required',
            'ativa' => 'required',
        ]);

        try {
            
            $turmas->turma = $request->input('turma');
            $turmas->descricao = $request->input('descricao');
            $turmas->cadastro_dias_id = $request->input('dias');
            $turmas->cadastro_horarios_id = $request->input('horarios');
            $turmas->salas_id = $request->input('sala');
            $turmas->professors_id = $request->input('professor');
            $turmas->turno = $request->input('turno');
            $turmas->ativa = $request->input('ativa');
            $turmas->obs = $request->input('obs');

            $turmas->save();

            $turmas = $this->turmas->paginate();
            return view(self::PATH.'turmasShow', ['turmas'=>$turmas])
                        ->with('msg', 'Turma cadastrada com sucesso!!!');

        } catch (\Throwable $th) {
            
            $turmas = $this->turmas->paginate();
            return view(self::PATH.'turmasShow', ['turmas'=>$turmas])
                        ->with('msg', 'ERRO! Não foi possível salvar as informações da turmas!');            

        }


    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        
        $turmas = $this->turmas->with(['cadastroDias', 'cadastroHorarios', 'sala', 'professor'])->find($id);

        $dias = CadastroDia::all();
        $horarios = CadastroHorario::all();
        $sala = Sala::all();
        $professor = Professor::all();        

        if($turmas->count() >= 1){
            return view(self::PATH.'turmasEdit', ['turmas'=>$turmas])
                                    ->with('dias', $dias)
                                    ->with('horarios', $horarios)
                                    ->with('salas', $sala)
                                    ->with('professores', $professor);
        }

    }

    public function update(Request $request, string $id)
    {
        
        $turmas = $this->turmas->find($id);
            
            $request->validate([
                'turma' => 'required|min:3|max:100',
                'dias' => 'required',
                'horarios' => 'required',
                'sala' => 'required',
                'turno' => 'required',
                'ativa' => 'required',
            ]);
    
            try {
                
                $turmas->turma = $request->input('turma');
                $turmas->descricao = $request->input('descricao');
                $turmas->cadastro_dias_id = $request->input('dias');
                $turmas->cadastro_horarios_id = $request->input('horarios');
                $turmas->salas_id = $request->input('sala');
                $turmas->professors_id = $request->input('professor');
                $turmas->turno = $request->input('turno');
                $turmas->ativa = $request->input('ativa');
                $turmas->obs = $request->input('obs');
    
                $turmas->save();
    
                $turmas = $this->turmas->with(['cadastroDias', 'cadastroHorarios'])->paginate(15);
                return view(self::PATH.'turmasShow', ['turmas'=>$turmas])
                            ->with('msg', 'Informações da turma atualizadas com sucesso!!!');
    
            } catch (\Throwable $th) {
                
                $turmas = $this->turmas->with(['cadastroDias', 'cadastroHorarios'])->paginate(15);
                return view(self::PATH.'turmasShow', ['turmas'=>$turmas])
                            ->with('msg', 'ERRO! Não foi possível atualizar as informações da turma!');            
    
            }

    }

    public function destroy(string $id)
    {
        
        $turmas = $this->turmas->find($id);

        try {
            $turmas->delete();

            $turmas = $this->turmas->with(['cadastroDias', 'cadastroHorarios'])->paginate(15);
            return view(self::PATH.'turmasShow', ['turmas'=>$turmas])
                        ->with('msg', 'Turma excluida com sucesso!');

        } catch (\Throwable $th) {

            $turmas = $this->turmas->with(['cadastroDias', 'cadastroHorarios'])->paginate(15);
            return view(self::PATH.'turmasShow', ['turmas'=>$turmas])
                        ->with('msg', 'ERRO! Não foi possível excluir a turma! '.$th); 
                        
        }

    }

    public function find(Request $request){

        $field = $request->input('opt');

        $value = $request->input('find');
        $field = $request->input('opt');        

        if(empty($field)){
            $field = 'id';
        }

        $turmas = Turma::where($field, 'LIKE', $value.'%')->with(['cadastroDias', 'cadastroHorarios'])->paginate(15);

        return view(self::PATH.'turmasShow', ['turmas'=>$turmas]);

    }

}
