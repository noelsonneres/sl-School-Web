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
use App\Http\Controllers\AlunosBloqueadosController;
use App\Http\Controllers\AlunosPorTurmaController;
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
use App\Http\Controllers\ContratosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NivelAcessoController;
use App\Http\Controllers\QuitarMensalidadeController;
use App\Http\Controllers\RelatorioAlunosController;
use App\Policies\AlunosPorTurmaPolicy;
use App\Policies\GradeHorariosPolicy;
use App\Policies\EstornarMensalidadePolicy;


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
Route::get('/matricula_localizar', [MatriculasController::class, 'find']);

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

Route::resource('matricula_cancelar', MatriculaCancelamentoController::class)->middleware('can:view, App\Models\MatriculaCancelamento');
Route::get('/cancelar_matricula/{id}', [MatriculaCancelamentoController::class, 'cancelarMatricula'])->middleware('can:view, App\Models\MatriculaCancelamento');
Route::get('/cancelar_matricula_localizar', [MatriculaCancelamentoController::class, 'selecionarMatricula'])->middleware('can:view, App\Models\MatriculaCancelamento');
// Route::get('/remover_turma_matricula/{id}', [MatriculaCancelamentoController::class, 'removerTurmas']);

Route::resource('trancar_matricula', MatriculaTrancamentoController::class)->middleware('can:view, App\Models\MatriculaTrancamento');
Route::get('/trancar_matricula_localizar', [MatriculaTrancamentoController::class, 'selecionarMatricula'])->middleware('can:view, App\Models\MatriculaTrancamento');

Route::resource('matricula_finalizar', MatriculaFinalizarController::class)->middleware('can:view, App\Models\MatriculaFinalizar');
Route::get('matricula_finalizar_localizar', [MatriculaFinalizarController::class, 'selecionarMatricula'])->middleware('can:view, App\Models\MatriculaFinalizar');

Route::resource('matricula_reativar', MatriculaReativarController::class)->middleware('can:view, App\Models\MatriculaReativar');
Route::get('matricula_reativar_localizar', [MatriculaReativarController::class, 'selecionarMatricula'])->middleware('can:view, App\Models\MatriculaReativar');

Route::get('/grade_horarios', [GradeHorariosController::class, 'grade'])->middleware('can:view,' . GradeHorariosPolicy::class);
Route::get('/grade_horarios_filtrar', [GradeHorariosController::class, 'filtrarGrade']);
Route::get('/grade_horarios_alunos/{turma}', [GradeHorariosController::class, 'gradeAlunos']);

Route::resource('frequencia', FrequenciaController::class)->middleware('can:view, App\Models\Frequencia');
Route::get('frequencia_adicionar/{id}', [FrequenciaController::class, 'adicionar'])->middleware('can:view, App\Models\Frequencia');
Route::get('frequencia_localizar', [FrequenciaController::class, 'localizarFrequencias'])->middleware('can:view, App\Models\Frequencia');
Route::get('frequencia_localiza_matricula', [FrequenciaController::class, 'selecionarMatricula'])->middleware('can:view, App\Models\Frequencia');

Route::resource('reposicoes',ReposicoesController::class)->middleware('can:view, App\Models\Reposicao');
Route::get('/reposicao_adicionar/{matricula}', [ReposicoesController::class, 'reposicao_adicionar'])->middleware('can:view, App\Models\Reposicao');
Route::get('/reposicao_selecionar/{matricula}/{turma}', [ReposicoesController::class, 'selecionarTurma'])->middleware('can:view, App\Models\Reposicao');
Route::post('/resposicao_marcar', [ReposicoesController::class, 'marcarReposicao'])->middleware('can:view, App\Models\Reposicao');
Route::get('/resposicao_localizar', [ReposicoesController::class, 'localizar'])->middleware('can:view, App\Models\Reposicao');
Route::get('/resposicao_localizar_matricula', [ReposicoesController::class, 'selecionarMatricula'])->middleware('can:view, App\Models\Reposicao');

Route::resource('plano_contas', PlanoContasController::class)->middleware('can:view, App\Models\PlanoContas');
Route::get('plano_contas_localizar', [PlanoContasController::class, 'find'])->middleware('can:view, App\Models\PlanoContas');

Route::resource('contas_pagar', ContasPagarController::class)->middleware('can:view, App\Models\ContasPagar');
Route::get('/contas_localizar', [ContasPagarController::class, 'find'])->middleware('can:view, App\Models\ContasPagar');

Route::get('/estornar_mensalidade', [EstornarMensalidadeController::class, 'index'])->middleware('can:view,' . EstornarMensalidadePolicy::class);
Route::get('/estornar_mensalidade_localizar', [EstornarMensalidadeController::class, 'localizarMensalidade'])->middleware('can:view,' . EstornarMensalidadePolicy::class);
Route::get('/estornar_mensalidade_estornar/{mensalidade}', [EstornarMensalidadeController::class, 'estornar'])->middleware('can:view,' . EstornarMensalidadePolicy::class);

Route::resource('entrada_valores', EntradaValoresController::class)->middleware('can:view, App\Models\EntradaValor');
Route::get('entrada_valores_localizar', [EntradaValoresController::class, 'find'])->middleware('can:view, App\Models\EntradaValor');

Route::resource('saida_valores', SaidaValoresController::class)->middleware('can:view, App\Models\Saidavalor');
Route::get('/saida_valores_localizar', [SaidaValoresController::class, 'find'])->middleware('can:view, App\Models\Saidavalor');

Route::resource('controle_caixa', ControleCaixaController::class)->middleware('can:view, App\Models\ControleCaixa');
Route::post('/controle_caixa_iniciar', [ControleCaixaController::class, 'iniciarCaixa'])->middleware('can:view, App\Models\ControleCaixa');
Route::get('/controle_caixa_novo_caixa', [ControleCaixaController::class, 'novoCaixa'])->middleware('can:view, App\Models\ControleCaixa');

Route::resource('conf_carteira', ConfCarteiraController::class)->middleware('can:view, App\Models\ConfCarteira');

Route::resource('impressao_carteira', ImpressaoCarteiraController::class)->middleware('can:view, App\Models\ImpressaoCarteira');
Route::get('/impressao_carteira_confirmar/{matricula}', [ImpressaoCarteiraController::class, 'confirmarDados'])->middleware('can:view, App\Models\ImpressaoCarteira');
Route::get('/impressao_carteira_loc_alunos', [ImpressaoCarteiraController::class, 'find'])->middleware('can:view, App\Models\ImpressaoCarteira');
Route::get('/impressao_carteira_impressao/{carteira}', [ImpressaoCarteiraController::class, 'impressao'])->middleware('can:view, App\Models\ImpressaoCarteira');

Route::resource('visitas', CadastroVisitaController::class)->middleware('can:view, App\Models\CadastroVisita');
Route::get('/visitas_localizar', [CadastroVisitaController::class, 'find'])->middleware('can:view, App\Models\CadastroVisita');

Route::resource('usuarios', UserController::class)->middleware('can:view, App\Models\User');
Route::get('/usuarios_localizar', [UserController::class, 'find'])->middleware('can:view, App\Models\User');

Route::resource('nivel_acesso', NivelAcessoController::class)->middleware('can:view, App\Models\NivelAcesso');
Route::post('/nivel_acesso_adicionar', [NivelAcessoController::class, 'adcionarRegra'])->middleware('can:view, App\Models\NivelAcesso');
Route::get('/nivel_acesso_bloquear/{nivelID}', [NivelAcessoController::class, 'bloquearAcesso'])->middleware('can:view, App\Models\NivelAcesso');
Route::get('/nivel_acesso_liberar/{nivelID}', [NivelAcessoController::class, 'liberarAcesso'])->middleware('can:view, App\Models\NivelAcesso');


// FASE 2
Route::get('/alunos_por_turma', [AlunosPorTurmaController::class, 'index'])->middleware('can:view,'.AlunosPorTurmaPolicy::class);
Route::get('/alunos_por_turma_listar', [AlunosPorTurmaController::class, 'selecionarAlunos'])->middleware('can:view,'.AlunosPorTurmaPolicy::class);

Route::resource('contrato', ContratosController::class)->middleware('can:view, App\Models\Contrato');
Route::get('/contrato_iniciar/{matricula}/{contrato}', [ContratosController::class, 'iniciarContrato']);
Route::get(' /listarModeloContratosImpressao/{matricula}', [ContratosController::class, 'listagemContratosImpressao']);

Route::resource('bloqueados', AlunosBloqueadosController::class)->middleware('can:view, App\Models\AlunoBloqueado');
Route::get('/bloqueados_visualizar/{id}', [AlunosBloqueadosController::class, 'visualizarInfoBloqueio'])->middleware('can:view, App\Models\AlunoBloqueado');

Route::get('/quitar_mensalidade_index', [QuitarMensalidadeController::class, 'index']);
Route::get('/quitar_mensalidade_localizar', [QuitarMensalidadeController::class, 'localizar']);

Route::get('/rel_Aluno_Index', [RelatorioAlunosController::class, 'index']);