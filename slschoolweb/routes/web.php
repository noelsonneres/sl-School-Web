<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
use App\Http\Controllers\MatriculasController;
use App\Http\Controllers\ResponsavelController;
use App\Http\Controllers\MatriculaTurmas;

Route::get('/', function () {
    return view('home');
});

Route::resource('dias', CadastroDiasController::class);
Route::get('/dia_pesquisar', [CadastroDiasController::class, 'find']);

Route::resource('horarios', CadastroHorariosController::class);

Route::resource('salas', SalasController::class);
Route::get('/sala_pesquisar', [SalasController::class, 'find']);

Route::resource('meios_pagamentos', MeiosPagamentosController::class);

Route::resource('config_mensalidades', ConfigMensalidadesController::class);

Route::resource('empresa', EmpresaController::class);

Route::resource('disciplinas', DisciplinasController::class);
Route::get('/disciplinas_pesquisar', [DisciplinasController::class, 'find']);

Route::resource('professores', ProfessoresController::class);
Route::get('/professores_pesquisar', [ProfessoresController::class, 'find']);

Route::resource('professor_disciplina', ProfessorDisciplinaController::class);
Route::get('/adicionar/{id}', [ProfessorDisciplinaController::class, 'adicionarDisciplina']);

Route::resource('consultores', ConsultoresController::class);
Route::get('/consultor_pesquisar', [ConsultoresController::class, 'find']);

Route::resource('cursos', CursosController::class);
Route::get('/cursos_pesquisar', [CursosController::class, 'find']);

Route::get('/cursos_disciplinas/{id}/{nome}', [CursosDisciplinasController::class, 'listar']);
Route::get('/ad_curso_disciplinas/{id}', [CursosDisciplinasController::class, 'adicionar']);
Route::post('/salvar_curso_disciplinas', [CursosDisciplinasController::class, 'salvar']);
Route::delete('/deletar_curso_disciplina/{id}', [CursosDisciplinasController::class, 'deletar']);

Route::resource('materiais', MateriaisEscolaresController::class);
Route::get('/materiais_pesquisar', [MateriaisEscolaresController::class, 'find']);

Route::resource('turma', TurmasController::class);
Route::get('/turma_pesquisar', [TurmasController::class, 'find']);

Route::get('/home_aluno', [HomeAlunosController::class, 'homeAlunos'])->name('home.alunos');
Route::get('/alunos_pesquisar', [HomeAlunosController::class, 'find'])->name('home.pesqusar');

Route::resource('alunos', AlunoController::class);

Route::resource('responsavel', ResponsavelController::class);
Route::get('/responsavel_adicionar/{id}/{home}', [ResponsavelController::class, 'adicionar'])->name('responsavel_adicionar');

Route::resource('matricula', MatriculasController::class);
Route::get('/matricula_home/{id}', [MatriculasController::class, 'homeMatricula']);
Route::get('/matricula_adicionar/{id}', [MatriculasController::class, 'adicionar']);

Route::resource('matricula_turmas', MatriculaTurma::class);