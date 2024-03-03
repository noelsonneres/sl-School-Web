@extends('layout.main')
@section('title', 'Sl-School - Alunos cadastrados')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Responsável</a></li>
                            <li class="breadcrumb-item active">Responsáveis do aluno</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Responsávels do aluno</h4>
                    <h5 class="mb-2 ms-3">Aluno(a):{{$aluno->nome}}</h5>

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
                                <a href="{{ ('/responsavel_adicionar/'.$aluno->id) }}" class="btn btn-primary">Novo</a>
                                <button class="btn btn-secondary" onclick="print()">Imprimir</button>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Aluno</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($responsaveis as $responsavel)
                            <tr>
                                <td>{{ $responsavel->id }}</td>
                                <td>{{ $responsavel->nome }}</td>
                                <td>{{ $responsavel->alunos->nome }}</td>
                                <td>{{ $responsavel->telefone }}</td>
                                <td>{{ $responsavel->celular }}</td>
                                <td>
                                    <div>
                                        <div class="row">

                                            <div class="col-2">
                                                <a href="{{ route('responsavel.edit', $responsavel->id) }}"
                                                   class="btn btn-success btn-sm"
                                                   title="Atualizar informações do responsável">
                                                    <i class="uil-edit-alt"></i>
                                                </a>
                                            </div>

                                            <div class="col-2">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" title="Excluir as informações do aluno"
                                                        data-bs-target="#myModal{{ $responsavel->id }}">
                                                    <i class="uil-trash-alt"></i>
                                                </button>
                                            </div>

                                            {{-- Modal --}}
                                            <div class="modal fade" id="myModal{{ $responsavel->id }}"
                                                 tabindex="-1" aria-labelledby="myModalLabel{{ $responsavel->id }}"
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="myModalLabel{{ $responsavel->id }}">Deseja
                                                                deletar o dia selecionado?</h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form method="POST" enctype="multipart/form-data"
                                                                  action="{{ route('responsavel.destroy', $responsavel->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <h3>Tem certeza que deseja deletar o aluno
                                                                    selecionado? Todas as matrículas é histórico de
                                                                    turmas serão
                                                                    deletados
                                                                    caso você exclua o aluno</h3>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cancelar
                                                                    </button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">Sim, quero
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
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <!-- Exibir a barra de paginação -->
                    <div class="row">
                        <div>
                            {{ $responsaveis->links('pagination::pagination') }}
                        </div>
                    </div>

                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
