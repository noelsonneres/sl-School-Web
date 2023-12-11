<?php

use App\Http\Controllers\ReposicoesController;
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

Route::resource('motivos_cancelamento', MotivoCancelamentoController::class);
Route::get('/motivos_cancelamento_find',  [MotivoCancelamentoController::class, 'find']);

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
