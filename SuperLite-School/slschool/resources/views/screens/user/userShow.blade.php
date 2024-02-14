@extends('layout.main')
@section('title', 'Sl-School - Página teste')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">usuários</a></li>
                            <li class="breadcrumb-item active">visualizar</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Visualizar usuários</h4>

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
                                <a href="{{ route('users.create') }}" class="btn btn-primary">Novo usuário</a>
                                <button class="btn btn-secondary" onclick="print()">Imprimir</button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="pt-3 ps-4">
                                
                                <form action="/user_search" method="get" id="searchForm">
                                    <div class="row">

                                        <div class="col-md-4 mb-3">
                                            <select class="form-control" name="criterio" id="criterio" required>
                                                <option value="">Critério de pesquisa</option>
                                                <option value="id">Código</option>
                                                <option value="name">Nome</option>
                                                <option value="user_name">Usuário</option>

                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <input class="form-control" type="text" name="pesquisa" id="pesquisa" required maxlength="100">
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
                                <th>#</th>
                                <th>Nome</th>
                                <th>Usuário</th>
                                <th>Data admissão</th>
                                <th>Ativo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->user_name }}</td>

                                    @if ($user->data_adminssao != null)
                                        <td>{{ date('d/m/Y', strtotime($user->data_adminssao)) }}</td>
                                    @else
                                        <td></td>
                                    @endif

                                    @if ($user->ativo == '1')
                                        <td>Sim</td>
                                    @else
                                        <td>Não</td>
                                    @endif

                                    <td>
                                        <div>
                                            <div class="row">

                                                <div class="col-2">
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-success btn-sm"
                                                        title="Atualizar informações do usuário">
                                                        <i class="uil-edit-alt"></i>
                                                    </a>
                                                </div>

                                                <div class="col-2">
                                                    <a href="#" class="btn btn-info btn-sm"
                                                        title="Niveis de acesso do usuário">
                                                        <i class="uil-lock"></i>
                                                    </a>
                                                </div>

                                                <div class="col-2">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#myModal{{ $user->id }}">
                                                        <i class="uil-trash-alt"></i>
                                                    </button>

                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="myModal{{ $user->id }}" tabindex="-1"
                                                        aria-labelledby="myModalLabel{{ $user->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="myModalLabel{{ $user->id }}">Deseja
                                                                        deletar este usuário?</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form method="POST"
                                                                        action="{{ route('users.destroy', $user->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <h3>Tem certeza que deseja deletar o usuário
                                                                            selecionado?</h3>
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
                            {{ $users->links('pagination::pagination') }}
                        </div>
                    </div>

                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

    <script>
        // Restaurar valores dos campos ao carregar a página
        window.onload = function() {
            restoreFormValues();
        };

        // Armazenar valores dos campos no armazenamento local ao enviar o formulário
        document.getElementById('searchForm').addEventListener('submit', function() {
            storeFormValues();
        });

        // Função para armazenar valores dos campos no armazenamento local
        function storeFormValues() {
            document.querySelectorAll('input, select').forEach(function(element) {
                localStorage.setItem(element.name, element.value);
            });
        }

        // Função para restaurar valores dos campos do armazenamento local
        function restoreFormValues() {
            document.querySelectorAll('input, select').forEach(function(element) {
                if (localStorage.getItem(element.name)) {
                    element.value = localStorage.getItem(element.name);
                }
            });
        }
    </script>    

@endsection
