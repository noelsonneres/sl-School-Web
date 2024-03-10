@extends('layout.main')
@section('title', 'Sl-School - Lista de disciplinas do curso')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cadastro base</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cursos</a></li>
                            <li class="breadcrumb-item active">Lista de disciplinas</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Lista de disciplinas do curso</h4>


                    <div class="mb-4">
                        <h5 class="ps-3">Curso: {{ $curso->curso }}</h5>
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

                    <div class="card border ms-2 pt-2 me-2 ps-3 mt-2">
                        <form action="{{route('cursos_disciplinas.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="curso" value="{{$curso->id}}">
                            <div class="mb-3 pe-3">
                                <label for="disciplina" class="form-label">Selecione uma disciplina</label>
                                <select class="form-control" name="disciplina" id="disciplina">
                                    @foreach ($listaDisciplinas as $lista)
                                        <option value="{{ $lista->id }}">{{ $lista->disciplina }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-2 mb-3">
                                <button type="submit" class="btn btn-sm btn-success">Salvar
                                    <i class="ri-save-3-fill"></i>
                                </button>
                                <a href="javascript:history.back()" class="btn btn-sm btn-danger">Cancelar
                                    <i class=" ri-close-circle-fill"></i>
                                </a>
                            </div>

                        </form>
                    </div>

                    <div class="row">

                    </div>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 ">
                        <thead>
                            <tr>
                                <th>Cód. Disciplina</th>
                                <th>Disciplina</th>
                                <th>Duração meses</th>
                                <th>Carga horária</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($disciplinas as $disciplina)
                                <tr>
                                    <td>{{ $disciplina->disciplinas->id}}</td>
                                    <td>{{ $disciplina->disciplinas->disciplina }}</td>
                                    <td>{{ $disciplina->disciplinas->duracao_meses }}</td>
                                    <td>{{ $disciplina->disciplinas->carga_horaria }}</td>

                                    <td>
                                        <div>
                                            <div class="row">

                                                <div class="col-3">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" title="Excluir sala de aula"
                                                        data-bs-target="#myModal{{ $disciplina->id }}">
                                                        <i class="uil-trash-alt"></i>
                                                    </button>

                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="myModal{{ $disciplina->id }}" tabindex="-1"
                                                        aria-labelledby="myModalLabel{{ $disciplina->id }}"
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
                                                                        action="{{ route('cursos_disciplinas.destroy', $disciplina->id) }}">
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
