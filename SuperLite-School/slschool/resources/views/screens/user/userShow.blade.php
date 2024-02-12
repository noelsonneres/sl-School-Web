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
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="pt-3 ps-4">
                        <a href="{{route('users.create')}}" class="btn btn-primary">Novo usuário</a>
                        <button class="btn btn-secondary" onclick="print()">Imprimir</button>
                    </div>

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
                                    <td>{{ $user->data_adminssao }}</td>

                                    @if ($user->ativo == '1')
                                        <td>Sim</td>
                                    @else
                                        <td>Não</td>
                                    @endif

                                    <td>
                                        <div>
                                            <div class="row">

                                                <div class="col-2">
                                                    <a href="#" class="btn btn-success btn-sm" title="Atualizar informações do usuário">
                                                        <i class="uil-edit-alt"></i>
                                                    </a>
                                                </div>

                                                <div class="col-2">

                                                    <form method="POST" class="delete-form" action="#">
                                                        @csrf
                                                        {{-- o método HTTP para exclusão deve ser o DELETE --}}
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this)" title="Deletar as informações do usuário">
                                                            <i class="uil-trash-alt"></i>
                                                        </button>
                                                    </form>

                                                    <script>
                                                        function confirmDelete(button) {
                                                            if (confirm('Tem certeza de que deseja excluir este item?')) {
                                                                var form = button.closest('form');
                                                                form.submit();
                                                            }
                                                        }
                                                    </script>

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


@endsection
