@extends('layout.main')
@section('title', 'Sl-School - Turmas do aluno')
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
                            <li class="breadcrumb-item active">Turmas do aluno</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Turmas do aluno</h4>

                    <div class="mb-3">
                        <h5>Aluno: {{$matriculaInfo->alunos->nome}}</h5>
                        <h5>Matrícula: {{$matriculaInfo->id}}</h5>
                    </div>

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
                                <a href="{{('/matricula_turmas_disponiveis/'.$matriculaInfo->id)}}" class="btn btn-primary">Adicionar turma</a>
                                <!-- Button trigger modal -->
                                <button class="btn btn-secondary" onclick="print()">Imprimir</button>
                                <a href="{{('/dashboard/'.$matriculaInfo->id)}}" class="btn btn-danger">Voltar</a>
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
                                <th>horarios</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($turmas as $turma)
                                <tr>
                                    <td>{{ $turma->turmas_id }}</td>
                                    <td>{{ $turma->turmas->turma }}</td>
                                    <td>{{ $turma->turmas->dias_aulas->dia }}</td>
                                    <td>{{ $turma->turmas->horarios_aulas->entrada }} - {{ $turma->turmas->horarios_aulas->saida }}</td>
                                    <td>{{ $turma->turmas->ativa }}</td>

                                    <td>
                                        <div>
                                            <div class="row">

                                                <div class="col-2">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" title="Excluir sala de aula"
                                                        data-bs-target="#myModal{{ $turma->id }}">
                                                        <i class="uil-trash-alt"></i>
                                                    </button>

                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="myModal{{ $turma->id }}"
                                                        tabindex="-1" aria-labelledby="myModalLabel{{ $turma->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="myModalLabel{{ $turma->id }}">Deseja
                                                                        deletar o dia selecionado?</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form method="POST" enctype="multipart/form-data"
                                                                        action="{{ route('matricula_turmas.destroy', $turma->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <h3>Tem certeza que deseja deletar o dia
                                                                            selecionado? Se houver turmas com o dia
                                                                            atrelado, não será possível a exclusão</h3>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Cancelar</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Sim, quero
                                                                                deletar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Fim Modal --}}
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
                            {{ $turmas->links('pagination::pagination') }}
                        </div>
                    </div>

                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
