<?php

use App\Http\Controllers\EntradaValoresController;
use App\Http\Controllers\EstornarMensalidadeController;
use App\Http\Controllers\ReposicoesController;
use App\Http\Controllers\SaidaValoresController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CadastroDiasController;
use App\Http\Controllers\CadastroHorariosController;
use App\Http\Controllers\SalasController;
use App\Http\Controllers\MeiosPagamentosController;
use App\Http\Controllers\ConfigMensalidadesController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\DisciplinasController;
use App\Http\Controllers\ProfessoresController;
use App\Http\Controllers\ProfessorDisciplinaController;
use App\Http\Controllers\ConsultoresController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\CursosDisciplinasController;
use App\Http\Controllers\MateriaisEscolaresController;
use App\Http\Controllers\TurmasController;
use App\Http\Controllers\HomeAlunosController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\FrequenciaController;
use App\Http\Controllers\GradeHorariosController;
use App\Http\Controllers\MatriculaCancelamentoController;
use App\Http\Controllers\MatriculaDisciplinasController;
use App\Http\Controllers\MatriculaFinalizarController;
use App\Http\Controllers\MatriculaMateriaisController;
use App\Http\Controllers\MatriculaReativarController;
use App\Http\Controllers\MatriculasController;
use App\Http\Controllers\MatriculaTrancamentoController;
use App\Http\Controllers\ResponsavelController;
use App\Http\Controllers\MatriculaTurmaController;
use App\Http\Controllers\MensalidadesController;
use App\Http\Controllers\MotivoCancelamentoController;
use App\Http\Controllers\PlanoContasController;
use App\Http\Controllers\ContasPagarController;
use App\Http\Controllers\ControleCaixaController;
use App\Http\Controllers\ConfCarteiraController;
use App\Http\Controllers\ImpressaoCarteiraController;
use App\Http\Controllers\CadastroVisitaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NivelAcessoController;


Route::get('/', function(){
    return view('screens.login.login');
});

// Route::get('/', function () {
//     return view('home');
// });

Route::post('/login', [LoginController::class, 'login'])->name('login.login');
Route::get('login_index', [LoginController::class, 'index'])->name('login.index');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');


Route::get('home', [HomeController::class, 'index']);

Route::resource('dias', CadastroDiasController::class)->middleware('can:view, App\Models\CadastroDia');
Route::get('/dia_pesquisar', [CadastroDiasController::class, 'find'])->middleware('can:view, App\Models\CadastroDia');

Route::resource('horarios', CadastroHorariosController::class)->middleware('can:view, App\Models\CadastroHorario');

Route::resource('salas', SalasController::class)->middleware('can:view, App\Models\Sala');
Route::get('/sala_pesquisar', [SalasController::class, 'find'])->middleware('can:view, App\Models\Sala');

Route::resource('meios_pagamentos', MeiosPagamentosController::class)->middleware('can:view, App\Models\MeiosPagamento');

Route::resource('config_mensalidades', ConfigMensalidadesController::class)->middleware('can:view, App\Models\ConfigMensalidade');

Route::resource('empresa', EmpresaController::class)->middleware('can:view, App\Models\Empresa');

Route::resource('disciplinas', DisciplinasController::class)->middleware('can:view, App\Models\Disciplina');  
Route::get('/disciplinas_pesquisar', [DisciplinasController::class, 'find'])->middleware('can:view, App\Models\Disciplina');  

Route::resource('professores', ProfessoresController::class)->middleware('can:view, App\Models\Professor');    
Route::get('/professores_pesquisar', [ProfessoresController::class, 'find'])->middleware('can:view, App\Models\Professor');   

Route::resource('professor_disciplina', ProfessorDisciplinaController::class)->middleware('can:view, App\Models\ProfessorDisciplina');  
Route::get('/adicionar/{id}', [ProfessorDisciplinaController::class, 'adicionarDisciplina'])->middleware('can:view, App\Models\ProfessorDisciplina'); 

Route::resource('consultores', ConsultoresController::class)->middleware('can:view, App\Models\Consultor');    
Route::get('/consultor_pesquisar', [ConsultoresController::class, 'find'])->middleware('can:view, App\Models\Consultor'); 

Route::resource('cursos', CursosController::class)->middleware('can:view, App\Models\Curso'); 
Route::get('/cursos_pesquisar', [CursosController::class, 'find'])->middleware('can:view, App\Models\Curso');

Route::get('/cursos_disciplinas/{id}/{nome}', [CursosDisciplinasController::class, 'listar'])->middleware('can:view, App\Models\Curso');
Route::get('/ad_curso_disciplinas/{id}', [CursosDisciplinasController::class, 'adicionar'])->middleware('can:view, App\Models\Curso');
Route::post('/salvar_curso_disciplinas', [CursosDisciplinasController::class, 'salvar'])->middleware('can:view, App\Models\Curso');
Route::delete('/deletar_curso_disciplina/{id}', [CursosDisciplinasController::class, 'deletar'])->middleware('can:view, App\Models\Curso');

Route::resource('materiais', MateriaisEscolaresController::class)->middleware('can:view, App\Models\MateriaisEscolar');
Route::get('/materiais_pesquisar', [MateriaisEscolaresController::class, 'find'])->middleware('can:view, App\Models\MateriaisEscolar');

Route::resource('turma', TurmasController::class)->middleware('can:view, App\Models\Turma');
Route::get('/turma_pesquisar', [TurmasController::class, 'find'])->middleware('can:view, App\Models\Turma');

Route::get('/home_aluno', [HomeAlunosController::class, 'homeAlunos'])->name('home.alunos');
Route::get('/alunos_pesquisar', [HomeAlunosController::class, 'find'])->name('home.pesqusar');

Route::resource('alunos', AlunoController::class);

Route::resource('responsavel', ResponsavelController::class);
Route::get('/responsavel_adicionar/{id}/{home}', [ResponsavelController::class, 'adicionar'])->name('responsavel_adicionar');

Route::resource('matricula', MatriculasController::class);
Route::get('/matricula_home/{id}', [MatriculasController::class, 'homeMatricula']);
Route::get('/matricula_adicionar/{id}', [MatriculasController::class, 'adicionar']);
Route::get('/exibirInfoMatricula/{matricula}', [MatriculasController::class, 'exibirInfoMatriculas']);

Route::resource('matricula_turmas', MatriculaTurmaController::class);
Route::get('/turmas_matricula_lista/{aluno}/{matricula}', [MatriculaTurmaController::class, 'listaTurmas']);
Route::get('/turmas_matriculas_inserir/{matricula}', [MatriculaTurmaController::class, 'inserir']);
Route::delete('/turmas_matriculas_remover/{matricula}/{turma}', [MatriculaTurmaController::class, 'remover']);

Route::resource('mensalidades', MensalidadesController::class);
Route::get('/mensalidades_gerar{fields}',[MensalidadesController::class, 'gerarMensalidades']);

Route::resource('mensalidades', MensalidadesController::class);
Route::get('/selecionar_pagameto/{mensalidade}/{matricula}', [MensalidadesController::class, 'selecionarPagamento']);
Route::put('/mensalidades_quitar', [MensalidadesController::class, 'quitar']);
Route::get('/mensalidades_impressao/{matricula}', [MensalidadesController::class, 'impressao']);
Route::get('/mensalidades_adicionar/{matricula}', [MensalidadesController::class, 'adicionar']);
Route::get('/mensalidades_capa', [MensalidadesController::class, 'capaCarne']);

Route::resource('matricula_materiais', MatriculaMateriaisController::class);
Route::get('/matricula_materiais_adicionar/{matricula}', [MatriculaMateriaisController::class, 'adicionar']);
Route::get('/matricula_material_parcela/{matricula}/{material}', [MatriculaMateriaisController::class, 'adicionarParcela']);
Route::get('/matricula_material_parcelas/{matricula}', [MatriculaMateriaisController::class, 'adicionarParcelas']);
Route::post('/matricula_material_gerar_parcela', [MatriculaMateriaisController::class, 'parcela']);

Route::resource('matricula_disciplina', MatriculaDisciplinasController::class);
Route::get('/matricula_disciplina_adicionar/{matricula}', [MatriculaDisciplinasController::class, 'adicionar']);

Route::resource('motivos_cancelamento', MotivoCancelamentoController::class)->middleware('can:view, App\Models\MotivoCancelamento');
Route::get('/motivos_cancelamento_find',  [MotivoCancelamentoController::class, 'find'])->middleware('can:view, App\Models\MotivoCancelamento');

Route::resource('matricula_cancelar', MatriculaCancelamentoController::class);
Route::get('/cancelar_matricula/{id}', [MatriculaCancelamentoController::class, 'cancelarMatricula']);
// Route::get('/remover_turma_matricula/{id}', [MatriculaCancelamentoController::class, 'removerTurmas']);

Route::resource('trancar_matricula', MatriculaTrancamentoController::class);

Route::resource('matricula_finalizar', MatriculaFinalizarController::class);

Route::resource('matricula_reativar', MatriculaReativarController::class);

Route::get('/grade_horarios', [GradeHorariosController::class, 'grade']);
Route::get('/grade_horarios_filtrar', [GradeHorariosController::class, 'filtrarGrade']);
Route::get('/grade_horarios_alunos/{turma}', [GradeHorariosController::class, 'gradeAlunos']);

Route::resource('frequencia', FrequenciaController::class);
Route::get('frequencia_adicionar/{id}', [FrequenciaController::class, 'adicionar']);
Route::get('frequencia_localizar', [FrequenciaController::class, 'localizarFrequencias']);

Route::resource('reposicoes',ReposicoesController::class);
Route::get('/reposicao_adicionar/{matricula}', [ReposicoesController::class, 'reposicao_adicionar']);
Route::get('/reposicao_selecionar/{matricula}/{turma}', [ReposicoesController::class, 'selecionarTurma']);
Route::post('/resposicao_marcar', [ReposicoesController::class, 'marcarReposicao']);
Route::get('/resposicao_localizar', [ReposicoesController::class, 'localizar']);

Route::resource('plano_contas', PlanoContasController::class);
Route::get('plano_contas_localizar', [PlanoContasController::class, 'find']);

Route::resource('contas_pagar', ContasPagarController::class);
Route::get('/contas_localizar', [ContasPagarController::class, 'find']);

Route::get('/estornar_mensalidade', [EstornarMensalidadeController::class, 'index']);
Route::get('/estornar_mensalidade_localizar', [EstornarMensalidadeController::class, 'localizarMensalidade']);
Route::get('/estornar_mensalidade_estornar/{mensalidade}', [EstornarMensalidadeController::class, 'estornar']);

Route::resource('entrada_valores', EntradaValoresController::class);
Route::get('entrada_valores_localizar', [EntradaValoresController::class, 'find']);

Route::resource('saida_valores', SaidaValoresController::class);
Route::get('/saida_valores_localizar', [SaidaValoresController::class, 'find']);

Route::resource('controle_caixa', ControleCaixaController::class);
Route::post('/controle_caixa_iniciar', [ControleCaixaController::class, 'iniciarCaixa']);
Route::get('/controle_caixa_novo_caixa', [ControleCaixaController::class, 'novoCaixa']);

Route::resource('conf_carteira', ConfCarteiraController::class);

Route::resource('impressao_carteira', ImpressaoCarteiraController::class);
Route::get('/impressao_carteira_confirmar/{matricula}', [ImpressaoCarteiraController::class, 'confirmarDados']);
Route::get('/impressao_carteira_loc_alunos', [ImpressaoCarteiraController::class, 'find']);
Route::get('/impressao_carteira_impressao/{carteira}', [ImpressaoCarteiraController::class, 'impressao']);

Route::resource('visitas', CadastroVisitaController::class);
Route::get('/visitas_localizar', [CadastroVisitaController::class, 'find']);

Route::resource('usuarios', UserController::class);
Route::get('/usuarios_localizar', [UserController::class, 'find']);

Route::resource('nivel_acesso', NivelAcessoController::class);
Route::post('/nivel_acesso_adicionar', [NivelAcessoController::class, 'adcionarRegra']);
Route::get('/nivel_acesso_bloquear/{nivelID}', [NivelAcessoController::class, 'bloquearAcesso']);
Route::get('/nivel_acesso_liberar/{nivelID}', [NivelAcessoController::class, 'liberarAcesso']);
