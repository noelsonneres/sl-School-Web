@extends('layout.main')
@section('title', 'Sl-School - Disciplinas do aluno')
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
                            <li class="breadcrumb-item active">Disciplinas do aluno</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Disciplinas do aluno</h4>
                    <h5>Aluno: {{ $matricula->alunos->nome }}</h5>
                    <h5 class="mb-3">Matrícula: {{ $matricula->id }}</h5>

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

                        <div class="row ps-3 pt-2 pe-3">

                            <form action="{{ route('matricula_disciplina.store') }}" method="post">
                                @csrf

                                <input type="hidden" name="aluno" value="{{ $matricula->alunos_id }}">
                                <input type="hidden" name="matricula" value="{{ $matricula->id }}">

                                <div>
                                    <label for="disciplina" class="form-label">Disciplina</label>
                                    <select class="form-control" name="disciplina" id="disciplina" required>
                                        <option value="">Selecione uma disciplina</option>
                                        @foreach ($listaDisciplinas as $lista)
                                            <option value="{{ $lista->id }}">{{ $lista->disciplina }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-sm btn-success">Salvar
                                        <i class="ri-save-3-fill"></i>
                                    </button>
                                    <a href="/professores" class="btn btn-sm btn-danger">Cancelar
                                        <i class=" ri-close-circle-fill"></i>
                                    </a>
                                </div>

                            </form>

                        </div>

                    </div>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Disciplina</th>
                                <th>Curso</th>
                                <th>Início</th>
                                <th>Término</th>
                                <th>Concluido</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($disciplinas as $lista)
                                <tr>

                                    <td>{{ $lista->disciplinas->id }}</td>
                                    <td>{{ $lista->disciplinas->disciplina }}</td>
                                    <td>{{ $lista->curso->curso ?? '' }}</td>

                                    @if ($lista->inicio != null)
                                        <td>{{ date('d/m/Y', strtotime($lista->inicio)) }}</td>
                                    @else
                                        <td></td>
                                    @endif

                                    @if ($lista->termino != null)
                                        <td>{{ date('d/m/Y', strtotime($lista->termino)) }}</td>
                                    @else
                                        <td></td>
                                    @endif

                                    <td>{{ $lista->concluido }}</td>

                                    <td>
                                        <div>
                                            <div class="row">

                                                <div class="col-3">
                                                    <a href="{{ route('matricula_disciplina.edit', $lista->id) }}"
                                                        class="btn btn-success btn-sm"
                                                        title="Atualizar informações horário de aula">
                                                        <i class="uil-edit-alt"></i>
                                                    </a>
                                                </div>

                                                <div class="col-3">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" title="Excluir sala de aula"
                                                        data-bs-target="#myModal{{ $lista->id }}">
                                                        <i class="uil-trash-alt"></i>
                                                    </button>

                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="myModal{{ $lista->id }}" tabindex="-1"
                                                        aria-labelledby="myModalLabel{{ $lista->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="myModalLabel{{ $lista->id }}">Deseja
                                                                        deletar o dia selecionado?</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form method="POST" enctype="multipart/form-data"
                                                                        action="{{ route('matricula_disciplina.destroy', $lista->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <h3>Tem certeza que deseja deletar o dia
                                                                            selecionado? Se houver turmas com o dia
                                                                            atrelado, não será possível a exclusão</h3>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
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
                            {{ $disciplinas->links('pagination::pagination') }}
                        </div>
                    </div>

                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
