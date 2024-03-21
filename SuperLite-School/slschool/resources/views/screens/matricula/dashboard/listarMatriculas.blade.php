@extends('layout.main')
@section('title', 'Sl-School - Lista de matrículas')
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
                            <li class="breadcrumb-item active">Lista de matrículas</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Lista de matrículas</h4>

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
                                <button class="btn btn-secondary" onclick="print()">Imprimir</button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="pt-3 ps-4">

                                <form action="{{('/matricula_localizar')}}" method="get">
                                    <div class="row">

                                        <div class="col-md-4 mb-3">
                                            <select class="form-control" name="criterio" id="criterio" required>
                                                @empty($inputs)
                                                    <option value="" disabled selected>Critério de pesquisa</option>
                                                @else
                                                    <option value="{{ $inputs['criterio'] }}">
                                                        @if ($inputs['criterio'] == 'alunos_id')
                                                            Código do aluno
                                                        @elseif($inputs['criterio'] == 'id')
                                                            Matrícula
                                                        @elseif($inputs['criterio'] == 'nome')
                                                            Nome
                                                        @else
                                                            CPF
                                                        @endif
                                                    </option>
                                                @endempty

                                                <option value="alunos_id">Código do aluno</option>
                                                <option value="id">matrícula</option>
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
                                <th>Matrícula</th>
                                <th>Aluno</th>
                                <th>Curso</th>
                                <th>Data de início</th>
                                <th>Ativa</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($matriculas as $lista)
                                <tr>
                                    <td>{{ $lista->id }}</td>
                                    <td>{{ $lista->alunos->nome }}</td>
                                    <td>{{ $lista->cursos->curso }}</td>
                                    <td>{{ date('d/m/Y', strtotime($lista->data_inicio)) }}</td>
                                    <td>{{ $lista->ativo }}</td>

                                    <td>
                                        <div>
                                            <div class="row">

                                                <div class="col-2">
                                                    <a href="{{ route('matricula.edit', $lista->id) }}"
                                                        class="btn btn-success btn-sm"
                                                        title="Atualizar informações da matrícula">
                                                        <i class="uil-edit-alt"></i>
                                                    </a>
                                                </div>

                                                <div class="col-2">
                                                    <a href="{{ '/dashboard/' . $lista->id }}" class="btn btn-info btn-sm"
                                                        title="Painel de matrícula">
                                                        <i class="uil-web-grid-alt"></i>
                                                    </a>
                                                </div>

                                                <div class="col-2">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        title="Excluir as informações da matrícula selecionada"
                                                        data-bs-target="#myModal{{ $lista->id }}">
                                                        <i class="uil-trash-alt"></i>
                                                    </button>
                                                </div>

                                                {{-- Modal --}}
                                                <div class="modal fade" id="myModal{{ $lista->id }}" tabindex="-1"
                                                    aria-labelledby="myModalLabel{{ $lista->id }}" aria-hidden="true">
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
                                                                    action="{{ route('matricula.destroy', $lista->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <h3>Tem certeza que deseja deletar o aluno
                                                                        selecionado? Todas as matrículas é histórico de
                                                                        turmas serão
                                                                        deletados
                                                                        caso você exclua o aluno</h3>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cancelar
                                                                        </button>
                                                                        <button type="submit" class="btn btn-danger">Sim,
                                                                            quero
                                                                            deletar
                                                                        </button>
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
                        {{ $matriculas->links('pagination::pagination') }}
                    </div>
                </div>

            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
