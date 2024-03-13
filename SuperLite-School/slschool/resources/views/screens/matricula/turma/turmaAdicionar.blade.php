@extends('layout.main')
@section('title', 'Sl-School - Lista das turmas disponíveis')
@section('content')

    <!-- Start Content -->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Matrículas</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Turmas do alun</a></li>
                            <li class="breadcrumb-item active">Adicionar turma</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Lista de turmas disponíveis</h4>

                    {{-- Exibe mensagens de sucesso ou erro --}}
                    @if (isset($msg))
                        <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                                justify-content-between align-items-end mb-3"
                            role="alert" style="text-align: center;">
                            <h5>{{ $msg }} </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>
                    @endif
                    {{-- Fim da mensagem de sucesso ou erro --}}

                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="row">


                    <div class="col-md-6">
                        <div class="pt-3 ps-4">

                            <form action="/matricula_turmas_search" method="get">

                                <input type="hidden" name="matricula" value="{{$matriculaID}}">

                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <select class="form-control" name="criterio" id="criterio" required>
                                            @empty($inputs)
                                                <option value="" disabled selected>Critério de pesquisa</option>
                                            @else
                                                <option value="{{ $inputs['criterio'] }}">
                                                    @if ($inputs['criterio'] == 'id')
                                                        Código
                                                    @elseif($inputs['criterio'] == 'turma')
                                                        Turma
                                                    @elseif($inputs['criterio'] == 'dia')
                                                        Dia
                                                    @elseif($inputs['criterio'] == 'horario')
                                                        Horário
                                                    @endif
                                                </option>
                                            @endempty

                                            <option value="id">Cód. Turma</option>
                                            <option value="turma">Turma</option>
                                            <option value="dia">Dia</option>
                                            <option value="horario">Horário</option>

                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <input class="form-control" type="text" name="pesquisa" id="pesquisa" required
                                            maxlength="100" value="{{ $inputs['pesquisa'] ?? '' }}">
                                    </div>

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Pesquisar
                                        </button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>

                <hr>
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 ">
                    <thead>
                        <tr>
                            <th>Cód. Turma</th>
                            <th>Turma</th>
                            <th>Dias</th>
                            <th>Horários</th>
                            <th>Sala</th>
                            <th>Ativa</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($listaTurmas as $lista)
                            <tr>

                                <td>{{ $lista->id }}</td>
                                <td>{{ $lista->turma }}</td>
                                <td>{{ $lista->dias_aulas->dia }}</td>
                                <td>{{ $lista->horarios_aulas->entrada }} - {{ $lista->horarios_aulas->saida }}</td>
                                <td>{{ $lista->salas_aulas->sala }}</td>
                                <td>{{ $lista->ativa }}</td>

                                <td>
                                    <div>
                                        <div class="row">

                                            <div class="col-2">
                                                <a href="{{ '/matricula_turmas_adicionar/' . $matriculaID . '/' . $lista->id }}"
                                                    class="btn btn-success btn-sm"
                                                    title="Adicionar esta turma à matrícula do aluno">
                                                    <i class="uil-plus-square"></i>
                                                </a>
                                            </div>

                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <!-- Exibir a barra de paginação -->
                <div class="row">
                    <div>
                        {{ $listaTurmas->links('pagination::pagination') }}
                    </div>
                </div>

            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
