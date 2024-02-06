<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard,
			template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="/img/icons/icon-48x48.png" />


    <title>@yield('title')</title>

    <!-- <link href="css/app.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="/css/app.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        .submenu {
            margin-left: 30px;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 12px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 6px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background-color: #f1f1f1;
            border-radius: 10px;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">Sl-School</span>
                </a>

                <ul class="sidebar-nav" style="overflow-y: auto;">
                    <li class="sidebar-header">
                        Menu
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link text-white" href="/home">
                            <i class="bi bi-house align-middle" style="font-size: 18px"></i></i> <span
                                class="align-middle">Home</span>
                        </a>
                    </li>

                    {{-- Menu de cadastros principal --}}

                    <li class="sidebar-item">
                        <a class="sidebar-link text-white" href="#sub-menu3" data-bs-toggle="collapse">
                            <i class="bi bi-folder-plus align-middle" style="font-size: 18px"></i></i> <span
                                class="align-middle">Cadastros</span>
                        </a>
                    </li>

                    <div id="sub-menu3" class="collapse bg-white " style="margin-left: 15px;">

                        @can('show', [App\Models\CadastroDia::class])
                            <a class="sidebar-link text-white" href="/dias">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Dias</span>
                            </a>
                        @endcan

                        @can('show', [App\Models\CadastroHorario::class])
                            <a class="sidebar-link text-white" href="/horarios">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Horários </span></a>
                        @endcan

                        @can('show', [App\Models\Sala::class])
                            <a class="sidebar-link text-white" href="/salas">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Salas </span></a>
                        @endcan

                        @can('show', [App\Models\MeiosPagamento::class])
                            <a class="sidebar-link text-white" href="/meios_pagamentos">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Meios de pagamentos</span>
                            </a>
                        @endcan

                        @can('show', [App\Models\ConfigMensalidade::class])
                            <a class="sidebar-link text-white" href="/config_mensalidades">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Conf. mensalidades</span></a>
                        @endcan

                        @can('show', [App\Models\Empresa::class])
                            <a class="sidebar-link text-white" href="/empresa">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Dados da empresa</span></a>
                        @endcan

                        @can('show', [App\Models\Disciplina::class])
                            <a class="sidebar-link text-white" href="/disciplinas">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Disciplinas</span></a>
                        @endcan

                        @can('show', [App\Models\Curso::class])
                            <a class="sidebar-link text-white" href="/cursos">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Cursos</span>
                            </a>
                        @endcan

                        @can('show', [App\Models\MateriaisEscolar::class])
                            <a class="sidebar-link text-white" href="/materiais">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Materiais escolares</span></a>
                        @endcan

                        @can('show', [App\Models\Turma::class])
                            <a class="sidebar-link text-white" href="/turma">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Turmas</span></a>
                        @endcan

                        @can('show', [App\Models\MotivoCancelamento::class])
                            <a class="sidebar-link text-white" href="/motivos_cancelamento">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Motivo cancelamento</span></a>
                        @endcan

                    </div>

                    {{-- Matrículas --}}

                    <li class="sidebar-item">
                        <a class="sidebar-link text-white" href="#sub-menu1" data-bs-toggle="collapse">
                            <i class="bi bi-person-square align-middle" style="font-size: 18px"></i></i> <span
                                class="align-middle">Movimentação</span>
                        </a>
                    </li>
                    <div id="sub-menu1" class="collapse" style="margin-left: 15px;">

                        <a class="sidebar-link text-white" href="/home_aluno">
                            <i class="align-middle" data-feather="arrow-right"></i>
                            <span class="align-middle">Alunos</span></a>

                        <a class="sidebar-link text-white" href="{{ route('matricula.index') }}">
                            <i class="align-middle" data-feather="arrow-right"></i>
                            <span class="align-middle">Matrículas</span></a>

                        @can('show', [\App\Policies\GradeHorariosPolicy::class])
                            <a class="sidebar-link text-white" href="/grade_horarios">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">
                                    Grade de horários </span></a>
                        @endcan

                        @can('show', [\App\Policies\AlunosPorTurmaPolicy::class])
                            <a class="sidebar-link text-white" href="/alunos_por_turma">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Alunos por turma</span></a>
                        @endcan


                        @can('show', [\App\Models\Frequencia::class])
                            <a class="sidebar-link text-white" href="{{ route('frequencia.index') }}">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Frequência</span></a>
                        @endcan

                        @can('show', [\App\Models\Reposicao::class])
                            <a class="sidebar-link text-white" href="{{ route('reposicoes.index') }}">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Reposição</span></a>
                        @endcan

                        @can('show', [\App\Models\MatriculaCancelamento::class])
                            <a class="sidebar-link text-white" href="{{ route('matricula_cancelar.index') }}">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Cancelar</span></a>
                        @endcan

                        @can('show', [\App\Models\MatriculaTrancamento::class])
                            <a class="sidebar-link text-white" href="{{ route('trancar_matricula.index') }}">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Trancar</span></a>
                        @endcan

                        @can('show', [\App\Models\MatriculaFinalizar::class])
                            <a class="sidebar-link text-white" href="{{ route('matricula_finalizar.index') }}">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Finalizar</span></a>
                        @endcan

                        {{-- @can('show', [\App\Models\AlunoBloqueado::class])
                            <a class="sidebar-link text-white" href="{{ route('bloqueados.index') }}">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Alunos bloqueados</span></a>
                        @endcan --}}

                        @can('show', [\App\Models\MatriculaReativar::class])
                            <a class="sidebar-link text-white" href="{{ route('matricula_reativar.index') }}">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Reativar</span></a>
                        @endcan

                    </div>

                    {{-- Financeiro --}}

                    <li class="sidebar-item">
                        <a class="sidebar-link text-white" href="#sub-menu4" data-bs-toggle="collapse">
                            <i class="bi bi-currency-dollar align-middle" style="font-size: 20px"></i><span
                                class="align-middle">Financeiro</span>
                        </a>
                    </li>
                    <div id="sub-menu4" class="collapse" style="margin-left: 15px;">

                        @can('show', [\App\Policies\PlanoContas::class])
                            <a class="sidebar-link text-white" href="/plano_contas">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Plano de contas</span></a>
                        @endcan

                        @can('show', [\App\Policies\ContasPagar::class])
                            <a class="sidebar-link text-white" href="/contas_pagar">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Contas a pagar</span></a>
                        @endcan

                        @can('show', [\App\Policies\EstornarMensalidadePolicy::class])
                            <a class="sidebar-link text-white" href="/estornar_mensalidade">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">
                                    Estornar mensalidades </span>
                            </a>
                        @endcan

                        @can('show', [\App\Policies\QuitarMensalidadePolicy::class])
                            <a class="sidebar-link text-white" href="/quitar_mensalidade_index">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">
                                    Quitar mensalidades </span>
                            </a>
                        @endcan

                        @can('show', [\App\Policies\EntradaValor::class])
                            <a class="sidebar-link text-white" href="/entrada_valores">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">
                                    Entrada de valores </span>
                            </a>
                        @endcan

                        @can('show', [\App\Policies\Saidavalor::class])
                            <a class="sidebar-link text-white" href="/saida_valores">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">
                                    Saida de valores </span>
                            </a>
                        @endcan

                        @can('show', [\App\Policies\ControleCaixa::class])
                            <a class="sidebar-link text-white" href="/controle_caixa">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">
                                    Caixa </span></a>
                        @endcan

                    </div>


                    {{-- Adminstrativo --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link text-white" href="#sub-menu6" data-bs-toggle="collapse">
                            <i class="bi bi-person-fill-gear align-middle" style="font-size: 20px"></i> <span
                                class="align-middle">Adminstrativo</span>
                        </a>
                    </li>

                    <div id="sub-menu6" class="collapse" style="margin-left: 15px;">

                        @can('show', [App\Models\User::class])
                            <a class="sidebar-link text-white" href="/usuarios">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Usuários</span>
                            </a>
                        @endcan

                        @can('show', [App\Models\Professor::class])
                            <a class="sidebar-link text-white" href="/professores">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Professores</span>
                            </a>
                        @endcan

                        @can('show', [App\Models\Consultor::class])
                            <a class="sidebar-link text-white" href="/consultores">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Consultores</span>
                            </a>
                        @endcan

                        @can('show', [\App\Models\Contrato::class])
                            <a class="sidebar-link text-white" href="{{ route('contrato.index') }}">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Modelo do contrato</span>
                            </a>
                        @endcan

                    </div>


                    {{-- Extras --}}

                    <li class="sidebar-item">
                        <a class="sidebar-link text-white" href="#sub-menu5" data-bs-toggle="collapse">
                            <i class="bi bi-star align-middle" style="font-size: 18px"></i> <span
                                class="align-middle">Extras</span>
                        </a>
                    </li>

                    <div id="sub-menu5" class="collapse" style="margin-left: 15px;">

                        @can('show', [\App\Policies\ConfCarteira::class])
                            <a class="sidebar-link text-white" href="/conf_carteira">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Conf. Imp. Cateira</span></a>
                        @endcan

                        @can('show', [\App\Policies\ImpressaoCarteira::class])
                            <a class="sidebar-link text-white" href="/impressao_carteira">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Impressão carteira</span>
                            </a>
                        @endcan

                        @can('show', [\App\Policies\CadastroVisita::class])
                            <a class="sidebar-link text-white" href="/visitas">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Visitas</span>
                            </a>
                        @endcan

                    </div>

                    {{-- RELATÓRIOS --}}

                    <li class="sidebar-header">
                        Relatórios
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link text-white" href="#sub-menu8" data-bs-toggle="collapse">
                            <i class="bi bi-person-fill-gear align-middle" style="font-size: 20px"></i> <span
                                class="align-middle">Alunos</span>
                        </a>
                    </li>

                    <div id="sub-menu8" class="collapse" style="margin-left: 15px;">

                        <a class="sidebar-link text-white" href="/rel_Aluno_Index">
                            <i class="align-middle" data-feather="arrow-right"></i>
                            <span class="align-middle">Alunos</span>
                        </a>

                        <a class="sidebar-link text-white" href="/rel_responsavel_index">
                            <i class="align-middle" data-feather="arrow-right"></i>
                            <span class="align-middle">Responsáveis</span>
                        </a>

                        <a class="sidebar-link text-white" href="/rel_matricula_index">
                            <i class="align-middle" data-feather="arrow-right"></i>
                            <span class="align-middle">Matrículas</span>
                        </a>

                        <a class="sidebar-link text-white" href="/rel_cancelados">
                            <i class="align-middle" data-feather="arrow-right"></i>
                            <span class="align-middle">Cancelados</span>
                        </a>

                        <a class="sidebar-link text-white" href="/rel_trancados">
                            <i class="align-middle" data-feather="arrow-right"></i>
                            <span class="align-middle">Trancados</span>
                        </a>

                        @can('show', [\App\Models\AlunoBloqueado::class])
                            <a class="sidebar-link text-white" href="{{ route('bloqueados.index') }}">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Alunos bloqueados</span></a>
                        @endcan

                        <a class="sidebar-link text-white" href="/rel_finalizados">
                            <i class="align-middle" data-feather="arrow-right"></i>
                            <span class="align-middle">Finalizados</span>
                        </a>    
                        
                        <a class="sidebar-link text-white" href="/rel_reativadas">
                            <i class="align-middle" data-feather="arrow-right"></i>
                            <span class="align-middle">Reativadas</span>
                        </a>                              

                    </div>

                    <li class="sidebar-item">
                        <a class="sidebar-link text-white" href="#sub-menu9" data-bs-toggle="collapse">
                            <i class="bi bi-person-fill-gear align-middle" style="font-size: 20px"></i> <span
                                class="align-middle">Mensalidades</span>
                        </a>
                    </li>

                    <div id="sub-menu9" class="collapse" style="margin-left: 15px;">
                        <a class="sidebar-link text-white" href="/rel_mensalidades">
                            <i class="align-middle" data-feather="arrow-right"></i>
                            <span class="align-middle">Mensalidades</span>
                        </a>      
                        
                        <a class="sidebar-link text-white" href="/rel_atrasadas">
                            <i class="align-middle" data-feather="arrow-right"></i>
                            <span class="align-middle">Mensalidade atrasadas</span>
                        </a>  

                        <a class="sidebar-link text-white" href="/rel_mensalidades_periodo">
                            <i class="align-middle" data-feather="arrow-right"></i>
                            <span class="align-middle">Período</span>
                        </a>                         

                    </div>

                    <li class="sidebar-item">
                        <a class="sidebar-link text-white" href="#sub-menu10" data-bs-toggle="collapse">
                            <i class="bi bi-person-fill-gear align-middle" style="font-size: 20px"></i> <span
                                class="align-middle">Financeiro</span>
                        </a>
                    </li>

                    <div id="sub-menu10" class="collapse" style="margin-left: 15px;">

                            <a class="sidebar-link text-white" href="/rel_contas_pagar">
                                <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Contas a pagar</span>
                            </a>  
                        
                            <a class="sidebar-link text-white" href="/rel_entrada_valores">
                                 <i class="align-middle" data-feather="arrow-right"></i>
                                <span class="align-middle">Entrada de valores</span>
                            </a>      
            

                    </div>     
                    


                    {{-- <li class="sidebar-header">
                        Gráficos
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="charts-chartjs.html">
                            <i class="align-middle" data-feather="bar-chart-2"></i> <span
                                class="align-middle">Charts</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="maps-google.html">
                            <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                        </a>
                    </li> --}}
                </ul>

        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the
                                                    update.
                                                </div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
                                                    hendrerit et.
                                                </div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.
                                                </div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li> --}}

                        {{-- <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i>
                                </div>
                            </a> --}}
                        {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        4 New Messages
                                    </div>
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="/img/avatars/avatar-5.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Vanessa Tucker</div>
                                                <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis
                                                    arcu
                                                    tortor.
                                                </div>
                                                <div class="text-muted small mt-1">15m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="/img/avatars/avatar-2.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="William Harris">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">William Harris</div>
                                                <div class="text-muted small mt-1">Curabitur ligula sapien euismod
                                                    vitae.
                                                </div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="/img/avatars/avatar-4.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="Christina Mason">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Christina Mason</div>
                                                <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.
                                                </div>
                                                <div class="text-muted small mt-1">4h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="/img/avatars/avatar-3.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Sharon Lessman</div>
                                                <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed,
                                                    posuere ac, mattis non.
                                                </div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all messages</a>
                                </div>
                            </div> --}}
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">

                                @if (auth()->check())
                                    <img src="/img/user/{{ auth()->user()->foto }}"
                                        class="avatar img-fluid rounded-circle me-1" alt="" /> <span
                                        class="text-dark">{{ auth()->user()->name }}</span>
                            </a>
                            @endif

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('login.logout') }}">
                                    <i class="bi bi-x-circle-fill" style="color: red"></i>
                                    Sair</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">

                <div class="container-fluid p-0 ">

                    @if ($errors->any())
                        <div class="text text-danger p-4">
                            <h4 class="text text-danger p-3">Verifiques os campos informados</h4>
                            <ul class="list-group list-group-flush">
                                @foreach ($errors->all() as $error)
                                    <li class="list-group-item text text-danger fs-4">* {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        {{-- <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/"
                                    target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted"
                                    href="https://adminkit.io/" target="_blank"><strong>Bootstrap
                                        Admin
                                        Template</strong></a> &copy;
                            </p>
                        </div> --}}
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Suporte</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Treinamento</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Privacidade</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Termos de uso</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="/js/app.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
            gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: "Sales ($)",
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: window.theme.primary,
                        data: [
                            2115,
                            1562,
                            1584,
                            1892,
                            1587,
                            1923,
                            2566,
                            2448,
                            2805,
                            3438,
                            2917,
                            3327
                        ]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 1000
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }]
                    }
                }
            });
        });
    </script>
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: ["Chrome", "Firefox", "IE"],
                    datasets: [{
                        data: [4306, 3801, 1689],
                        backgroundColor: [
                            window.theme.primary,
                            window.theme.warning,
                            window.theme.danger
                        ],
                        borderWidth: 5
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 75
                }
            });
        });
    </script> -->
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: "This year",
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        hoverBackgroundColor: window.theme.primary,
                        hoverBorderColor: window.theme.primary,
                        data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                        barPercentage: .75,
                        categoryPercentage: .5
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            stacked: false,
                            ticks: {
                                stepSize: 20
                            }
                        }],
                        xAxes: [{
                            stacked: false,
                            gridLines: {
                                color: "transparent"
                            }
                        }]
                    }
                }
            });
        });
    </script> -->
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var markers = [{
                    coords: [31.230391, 121.473701],
                    name: "Shanghai"
                },
                {
                    coords: [28.704060, 77.102493],
                    name: "Delhi"
                },
                {
                    coords: [6.524379, 3.379206],
                    name: "Lagos"
                },
                {
                    coords: [35.689487, 139.691711],
                    name: "Tokyo"
                },
                {
                    coords: [23.129110, 113.264381],
                    name: "Guangzhou"
                },
                {
                    coords: [40.7127837, -74.0059413],
                    name: "New York"
                },
                {
                    coords: [34.052235, -118.243683],
                    name: "Los Angeles"
                },
                {
                    coords: [41.878113, -87.629799],
                    name: "Chicago"
                },
                {
                    coords: [51.507351, -0.127758],
                    name: "London"
                },
                {
                    coords: [40.416775, -3.703790],
                    name: "Madrid "
                }
            ];
            var map = new jsVectorMap({
                map: "world",
                selector: "#world_map",
                zoomButtons: true,
                markers: markers,
                markerStyle: {
                    initial: {
                        r: 9,
                        strokeWidth: 7,
                        stokeOpacity: .4,
                        fill: window.theme.primary
                    },
                    hover: {
                        fill: window.theme.primary,
                        stroke: window.theme.primary
                    }
                },
                zoomOnScroll: false
            });
            window.addEventListener("resize", () => {
                map.updateSize();
            });
        });
    </script> -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
            var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
            document.getElementById("datetimepicker-dashboard").flatpickr({
                inline: true,
                prevArrow: "<span title=\"Previous month\">&laquo;</span>",
                nextArrow: "<span title=\"Next month\">&raquo;</span>",
                defaultDate: defaultDate
            });
        });
    </script>

</body>

</html>
