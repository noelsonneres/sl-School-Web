@extends('layout.main')
@section('title', 'Sl-School - Disciplinas do professor')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admintrativo</a></li>
                            <li class="breadcrumb-item active">Professores</li>
                            <li class="breadcrumb-item active">Disciplinas</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Disciplinas do professor</h4>

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

                    <div class="row ps-3 pt-2 pe-3">

                        <form action="{{ route('professor_disciplinas.store') }}" method="post">
                            @csrf

                            <input type="hidden" name="professor" value="{{ $professor }}">

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
                    <hr>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Disciplina</th>
                                <th>Duração em meses</th>
                                <th>Carga horária</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($disciplinas as $disciplina)
                                <tr>

                                    <td>{{ $disciplina->disciplinas_id }}</td>
                                    <td>{{ $disciplina->disciplina->disciplina }}</td>
                                    <td>{{ $disciplina->disciplina->duracao_meses }}</td>
                                    <td>{{ $disciplina->disciplina->carga_horaria }}</td>

                                    {{-- <td>{{ Str::substr($professor->professor, 0, 30) }}</td> --}}

                                    <td>
                                        <div>
                                            <div class="row">

                                                <div class="col-2">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" title="Remover disciplina do professor"
                                                        data-bs-target="#myModal{{ $disciplina->id }}">
                                                        <i class="uil-trash-alt"></i>
                                                    </button>

                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="myModal{{ $disciplina->id }}"
                                                        tabindex="-1" aria-labelledby="myModalLabel{{ $disciplina->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="myModalLabel{{ $disciplina->id }}">Deseja
                                                                        deletar o dia selecionado?</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form method="POST" enctype="multipart/form-data"
                                                                        action="{{ route('professor_disciplinas.destroy', $disciplina->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <h3>Tem certeza que deseja deletar o dia
                                                                            selecionado? Se houver turmas com o dia
                                                                            atrelado, não será possível a exclusão</h3>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Cancelar</button>
                                                                            <button type="submit"
                                                                                title="Remover disciplina do professor"
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
