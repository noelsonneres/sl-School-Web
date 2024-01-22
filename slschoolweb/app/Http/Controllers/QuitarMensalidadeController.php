<?php

namespace App\Http\Controllers;

use App\Models\Mensalidade;
use Illuminate\Http\Request;

class QuitarMensalidadeController extends Controller
{
    
    const PATH = 'screens.quitarMensalidade.';
    private $mensalidade;

    public function __construct()
    {
        $this->mensalidade = new Mensalidade();
    }

    public function index(){
        $mensalidades = $this->mensalidade->where('matriculas_id', 0)->paginate();
        return view(self::PATH.'quitarMensalidade', ['mensalidades'=>$mensalidades]);
    }

    public function localizar(Request $request){
        $value = $request->input('find');
        $field = $request->input('opt');

        if (empty($field)) {
            $field = 'id';
        }

        $mensalidades = $this->mensalidade->where($field, 'LIKE', $value)->paginate();

        return view(self::PATH.'quitarMensalidade', ['mensalidades'=>$mensalidades]);

    }

    public function quitar(){

    }

}
