<?php

use App\Http\Controllers\AlunosBloqueadosController;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\ConfigurarMensalidadesController;
use App\Http\Controllers\ConsultoresController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\CursosDisciplinasController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\DiasAulasController;
use App\Http\Controllers\DisciplinasController;
use App\Http\Controllers\FormasPagamentosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorariosAulasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MateriaisEscolaresController;
use App\Http\Controllers\MatriculaDiscplinasController;
use App\Http\Controllers\MatriculaMateriaisController;
use App\Http\Controllers\MatriculasController;
use App\Http\Controllers\MatriculaTurmasController;
use App\Http\Controllers\ProfessorDisciplinasController;
use App\Http\Controllers\ProfessoresController;
use App\Http\Controllers\ResponsavelAlunosController;
use App\Http\Controllers\SalaAulasController;
use App\Http\Controllers\TurmasController;
use App\Http\Controllers\UserController;
use App\Models\AlunoBloqueado;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('screens.login.login');
});

Route::post('/login', [LoginController::class, 'login'])->name('login.login');
Route::get('login_index', [LoginController::class, 'index'])->name('login.index');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('index', [HomeController::class, 'index']);

Route::resource('users', UserController::class);
Route::get('/user_search', [UserController::class, 'search']);

Route::resource('diasAula', DiasAulasController::class);
Route::get('/dias_search', [DiasAulasController::class, 'search']);

Route::resource('horarioAula', HorariosAulasController::class);

Route::resource('salasAulas', SalaAulasController::class);
Route::get('/salasAulas_search', [SalaAulasController::class, 'search']);

Route::resource('disciplinas', DisciplinasController::class);
Route::get('/disciplinas_search',[DisciplinasController::class, 'search']);

Route::resource('professores', ProfessoresController::class);
Route::get('/professores_search', [ProfessoresController::class, 'search']);

Route::resource('professor_disciplinas', ProfessorDisciplinasController::class);

Route::resource('formas_pagamentos', FormasPagamentosController::class);

Route::resource('configurar_mensalidade', ConfigurarMensalidadesController::class);

Route::resource('consultores', ConsultoresController::class);
Route::get('/consultores_search', [ConsultoresController::class, 'search']);

Route::resource('cursos', CursosController::class);
Route::get('/cursos_search', [CursosController::class, 'search']);

Route::resource('cursos_disciplinas', CursosDisciplinasController::class);

Route::resource('material', MateriaisEscolaresController::class);
Route::get('/material_search', [MateriaisEscolaresController::class, 'search']);

Route::resource('turmas', TurmasController::class);
Route::get('turmas_search', [TurmasController::class, 'search']);

// FASE 2

Route::resource('alunos', AlunosController::class);
Route::get('/alunos_search', [AlunosController::class, 'search']);

Route::resource('responsavel', ResponsavelAlunosController::class);
Route::get('/responsavel_adicionar/{alunoID}', [ResponsavelAlunosController::class, 'novoResponsavel']);

Route::resource('bloqueados', AlunosBloqueadosController::class);
Route::get('/bloqueados_sel_alunos', [AlunosBloqueadosController::class, 'selecionarAluno']);
Route::get('/bloqueados_loc_alunos', [AlunosBloqueadosController::class, 'localizarAluno']);
Route::get('/bloqueados_iniciar/{nome}/{id}', [AlunosBloqueadosController::class, 'iniciarBloqueio']);
Route::get('/bloqueados_search', [AlunosBloqueadosController::class, 'search']);

Route::resource('matricula', MatriculasController::class);
Route::get('matricula_adicionar/{aluno}/{responsavel}', [MatriculasController::class, 'novaMatricula']);

Route::get('dashboard/{matriculaID}', [DashBoardController::class, 'index']);

Route::resource('matricula_turmas', MatriculaTurmasController::class);
Route::get('/matricula_turmas_disponiveis/{matricula}', [MatriculaTurmasController::class, 'visualizarTurmas']);
Route::get('/matricula_turmas_adicionar/{matricula}/{turma}', [MatriculaTurmasController::class, 'adicionarTurma']);
Route::get('/matricula_turmas_search', [MatriculaTurmasController::class, 'search']);

Route::resource('matricula_disciplina', MatriculaDiscplinasController::class);
Route::get('/matricula_disciplina_add/{matricula}/{aluno}', [MatriculaDiscplinasController::class, 'novaDisciplina']);

Route::resource('matricula_materiais', MatriculaMateriaisController::class);