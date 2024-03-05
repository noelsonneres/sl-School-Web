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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Alunos bloqueados</a></li>
                            <li class="breadcrumb-item active">Selecionar alunos</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Selecione o aluno que deseja bloquear</h4>

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

                        </div>

                        <div class="col-md-6">
                            <div class="pt-3 ps-4">

                                <form action="/bloqueados_loc_alunos" method="get">
                                    <div class="row">

                                        <div class="col-md-4 mb-3">
                                            <select class="form-control" name="criterio" id="criterio" required>
                                                @empty($inputs)
                                                    <option value="" disabled selected>Critério de pesquisa</option>
                                                @else
                                                    <option value="{{ $inputs['criterio'] }}">
                                                        @if ($inputs['criterio'] == 'id')
                                                            Código
                                                            @elif($inputs['criterio'] == 'nome')
                                                            Nome
                                                        @else
                                                            CPF
                                                        @endif
                                                    </option>
                                                @endempty

                                                <option value="id">Código</option>
                                                <option value="nome">Nome</option>
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
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Celular</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($alunos as $aluno)
                                <tr>

                                    <td>{{ $aluno->id }}</td>
                                    <td>{{ $aluno->nome }}</td>
                                    <td>{{ $aluno->cpf }}</td>
                                    <td>{{ $aluno->telefone }}</td>
                                    <td>{{ $aluno->celular }}</td>
                                    <td>{{ $aluno->ativo }}</td>

                                    <td>
                                        <div>
                                            <div class="row">

                                                @if ($aluno->ativo == 'ativo')
                                                    <div class="col-2">
                                                        <a href="{{ '/bloqueados_iniciar/' . $aluno->nome . '/' . $aluno->id }}"
                                                            class="btn btn-success btn-sm" title="Selecionar aluno">
                                                            <i class=" uil-check-circle"></i>
                                                        </a>
                                                    </div>
                                                @endif

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
                            {{ $alunos->links('pagination::pagination') }}
                        </div>
                    </div>

                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
