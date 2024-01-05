<?php

namespace App\Http\Controllers;

use App\Models\NivelAcesso;
use App\Models\User;
use Illuminate\Http\Request;

class NivelAcessoController extends Controller
{

    const PATH = 'screens.usuarios.acesso.';
    private $nivel;

    const listaDeRecursos = [
        'Cad.Dias',
        'Cad.Horários',
        'Cad.Salas',
        'Meios de pagamento',
        'Conf.Mensalidades',
        'Dados da empresa',
        'Disciplinas',
        'Cursos',
        'Professores',
        'Diciplinas professores',
        'Consultores',
        'Materiais escolares',
        'Turmas',
        'Motivos de cancelamento',
        'Cadastro de alunos',
        'Editar aluno',
        'Excluir aluno',
        'Matricula',
        'Editar matricula',
        'Excluir matricula',
        'Cadastrar responsavel',
        'Editar responsavel',
        'Excluir responsavel',
        'Quitar mensalidade',
        'Adicionar mensalidade',
        'Editar mensalidade',
        'Excluir mensalidade',
        'Estornar mensalidade',
        'Adicionar turmas', //Adicionar turma à matrícula do aluno
        'Adicionar materiais',
        'Adicionar disciplinas',
        'Gerar contrato',
        'Frequencia do aluno',
        'Reposição do aluno',
        'Cancelar matricula',
        'Trancar matricula',
        'Finalizar matricula',
        'Reativar matricula',
        'Plano de contas',
        'Contas a pagar',
        'Entrada de valores',
        'Saida de valores',
        'Caixa',
        'Conf. Impressao carteira',
        'Impressão carteira',
        'Cadastro de visitas',
        'Grade de horários',
        'Cadastro de usuários',
        'Nível de acesso'
    ];

    public function __construct()
    {
        $this->nivel = new NivelAcesso();
    }

    public function index()
    {
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

        $nivel = $this->nivel->where('users_id', $id)->paginate();
        $usuario = User::find($id);
        return view(self::PATH . 'usuarioNivelAcesso', [
            'niveis' => $nivel,
            'usuario' => $usuario, 'recursos' => $this->listaRecursos()
        ]);
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

    public function bloquearAcesso(string $nivelID)
    {

        $nivel = $this->nivel->find($nivelID);

        if ($nivel != null) {

            $userID = $nivel->users_id;

            try {
                $nivel->permitido = 'não';
                $nivel->save();

                $nivel = $this->nivel->where('users_id', $userID)->paginate();
                $usuario = User::find($userID);
                return view(self::PATH . 'usuarioNivelAcesso', [
                    'niveis' => $nivel,
                    'usuario' => $usuario, 'recursos' => $this->listaRecursos()
                ])
                    ->with('msg', 'SUCESSO! Informações atualizadas com sucesso!');
            } catch (\Throwable $th) {
                return redirect()->back()->with('msg', 'ERRO! Não foi possível atualizar os recursos!');
            }
        } else {
            return redirect()->back()->with('msg', 'ATENÇÃO! Não foi possível localizar o recurso!');
        }
    }

    public function liberarAcesso(string $nivelID)
    {

        $nivel = $this->nivel->find($nivelID);

        if ($nivel != null) {

            $userID = $nivel->users_id;

            try {
                $nivel->permitido = 'sim';
                $nivel->save();

                $nivel = $this->nivel->where('users_id', $userID)->paginate();
                $usuario = User::find($userID);
                return view(self::PATH . 'usuarioNivelAcesso', [
                    'niveis' => $nivel,
                    'usuario' => $usuario, 'recursos' => $this->listaRecursos()
                ])
                    ->with('msg', 'SUCESSO! Informações atualizadas com sucesso!');
            } catch (\Throwable $th) {
                return redirect()->back()->with('msg', 'ERRO! Não foi possível atualizar os recursos!');
            }
        } else {
            return redirect()->back()->with('msg', 'ATENÇÃO! Não foi possível localizar o recurso!');
        }
    }

    private function listaRecursos()
    {
        $list = [
            'Cad.Dias',
            'Cad.Horários',
            'Cad.Salas',
            'Meios de pagamento',
            'Conf.Mensalidades',
            'Dados da empresa',
            'Disciplinas',
            'Cursos',
            'Professores',
            'Diciplinas professores',
            'Consultores',
            'Materiais escolares',
            'Turmas',
            'Motivos de cancelamento',
            'Cadastro de alunos',
            'Editar aluno',
            'Excluir aluno',
            'Matricula',
            'Editar matricula',
            'Excluir matricula',
            'Cadastrar responsavel',
            'Editar responsavel',
            'Excluir responsavel',
            'Quitar mensalidade',
            'Adicionar mensalidade',
            'Editar mensalidade',
            'Excluir mensalidade',
            'Estornar mensalidade',
            'Adicionar turmas', //Adicionar turma à matrícula do aluno
            'Adicionar materiais',
            'Adicionar disciplinas',
            'Gerar contrato',
            'Frequencia do aluno',
            'Reposição do aluno',
            'Cancelar matricula',
            'Trancar matricula',
            'Finalizar matricula',
            'Reativar matricula',
            'Plano de contas',
            'Contas a pagar',
            'Entrada de valores',
            'Saida de valores',
            'Caixa',
            'Conf. Impressao carteira',
            'Impressão carteira',
            'Cadastro de visitas',
            'Grade de horários',
            'Cadastro de usuários',
            'Nível de acesso',
            'PERMITIR ACESSO A TODOS OS RECURSOS',
            'NEGAR ACESSO A TODOS OS RECURSOS'
        ];

        return $list;
    }

    public function adcionarRegra(Request $request)
    {

        $nivel = $this->nivel;

        $request->validate([
            'recurso' => 'required',
        ], [
            'recurso.required' => 'Selecione uma opção para o Nível de acesso do usuário!',
        ]);

        $msg = '';

        if ($this->verificar($request->input('userID'), $request->input('recurso')) == 0) {

            try {

                if ($request->input('recurso') == 'PERMITIR ACESSO A TODOS OS RECURSOS') {
                    $this->permitirAcesso($request->input('userID'));
                } elseif ($request->input('recurso') == 'NEGAR ACESSO A TODOS OS RECURSOS') {
                    $this->negarAcesso($request->input('userID'));
                } else {

                    $nivel->users_id = $request->input('userID');
                    $nivel->recurso = $request->input('recurso');
                    $nivel->permitido = 'sim';
                    $nivel->save();
                }

                $msg = 'SUCESSO! Acesso concedido ao usuário!';
            } catch (\Throwable $th) {
                $msg = 'ERRO! Não foi possível conceder acesso a este recurso para o usuário: ' . $th->getMessage();
            }
        } else {
            $msg = 'ATENÇÃO! Este recurso já esta adiconado para este usuário';
        }

        $nivel = $this->nivel->where('users_id', $request->input('userID'))->paginate();
        $usuario = User::find($request->input('userID'));
        return view(self::PATH . 'usuarioNivelAcesso', [
            'niveis' => $nivel,
            'usuario' => $usuario, 'recursos' => $this->listaRecursos()
        ])
            ->with('msg', $msg);
    }

    public function verificar(string $userID, string $recurso)
    {

        $acesso = $this->nivel->where('users_id', $userID)->where('recurso', $recurso)->get();

        if ($acesso->count() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    private function permitirAcesso(string $userID)
    {

        $nivel = $this->nivel->where('users_id', $userID)->delete();

        foreach (self::listaDeRecursos as $lista) {

            $nivel = new NivelAcesso();

            $nivel->users_id = $userID;
            $nivel->recurso = $lista;
            $nivel->permitido = 'sim';

            $nivel->save();
        }
    }

    private function negarAcesso(string $userID)
    {

        $nivel = $this->nivel->where('users_id', $userID)->delete();

        foreach (self::listaDeRecursos as $lista) {

            $nivel = new NivelAcesso();

            $nivel->users_id = $userID;
            $nivel->recurso = $lista;
            $nivel->permitido = 'não';

            $nivel->save();
        }
    }
}
