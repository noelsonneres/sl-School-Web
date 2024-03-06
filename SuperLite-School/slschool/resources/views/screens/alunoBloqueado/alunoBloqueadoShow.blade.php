@extends('layout.main')
@section('title', 'Sl-School - Alunos bloqueados')
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
                            <li class="breadcrumb-item active">Alunos bloqueados</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Alunos bloqueados</h4>
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
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="pt-3 ps-4">
                                <a href="{{ '/bloqueados_sel_alunos' }}" class="btn btn-primary">Bloquear aluno</a>
                                <!-- Button trigger modal -->
                                <button class="btn btn-secondary" onclick="print()">Imprimir</button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="pt-3 ps-4">

                                <form action="/bloqueados_search" method="get">
                                    <div class="row">

                                        <div class="col-md-4 mb-3">
                                            <select class="form-control" name="criterio" id="criterio" required>
                                                @empty($inputs)
                                                    <option value="" disabled selected>Critério de pesquisa</option>
                                                @else
                                                    <option value="{{ $inputs['criterio'] }}">
                                                        @if ($inputs['criterio'] == 'id')
                                                            Código do aluno
                                                        @elseif($inputs['criterio'] == 'nome')
                                                            Nome do aluno
                                                        @else
                                                            CPF
                                                        @endif
                                                    </option>
                                                @endempty

                                                <option value="alunos_id">Código do aluno</option>
                                                <option value="nome">Nome do aluno</option>
                                                <option value="cpf">CPF</option>

                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <input class="form-control" type="text" name="pesquisa" id="pesquisa"
                                                required maxlength="100" value="{{ $inputs['pesquisa'] ?? '' }}">
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
                                <th>Cód. Aluno</th>
                                <th>Nome</th>
                                <th>Data</th>
                                <th>Motivo</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($bloqueados as $bloqueado)
                                <tr>
                                    <td>{{ $bloqueado->alunos_id }}</td>
                                    <td>{{ $bloqueado->alunos->nome }}</td>
                                    <td>{{ date('d/m/Y', strtotime($bloqueado->data)) }}</td>
                                    <td>{{ $bloqueado->motivo }}</td>
                                    <td>{{ $bloqueado->status }}</td>

                                    <td>
                                        <div>
                                            <div class="row">

                                                <div class="col-3">
                                                    <a href="{{ route('bloqueados.edit', $bloqueado->id) }}"
                                                        class="btn btn-primary btn-sm" title="Desbloquear aluno">
                                                        <i class="uil-unlock"></i>
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
                            {{ $bloqueados->links('pagination::pagination') }}
                        </div>
                    </div>

                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
