@extends('layout.main')
@section('title', 'Sl-School - Adicionar Disciplina')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Disciplinas do aluno</a></li>
                            <li class="breadcrumb-item active">Adicionar Disciplinas</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Disciplinas do aluno</h4>
                    {{-- <h5>Aluno: {{$matricula->alunos->nome}}</h5>
                    <h5 class="mb-3">Matrícula: {{$matricula->id}}</h5> --}}

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

                    </div>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Disciplina</th>
                                <th>Duração</th>
                                <th>Carga horária</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($listaDisciplinas as $lista)
                                <tr>

                                    <td>{{ $lista->id }}</td>
                                    <td>{{ $lista->disciplina }}</td>
                                    <td>{{ $lista->duracao_meses }}</td>
                                    <td>{{ $lista->carga_horaria }}</td>

                                    <td>
                                        <div>
                                            <div class="row">

                                                <div class="col-2">
                                                    <a href="{{ route('matricula_disciplina.edit', $lista->id) }}"
                                                        class="btn btn-primary btn-sm"
                                                        title="Atualizar informações horário de aula">
                                                        <i class="uil-edit-alt"></i>
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
                            {{ $listaDisciplinas->links('pagination::pagination') }}
                        </div>
                    </div>

                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
