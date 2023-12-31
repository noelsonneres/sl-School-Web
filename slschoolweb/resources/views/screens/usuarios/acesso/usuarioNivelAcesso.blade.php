@extends('layouts.main')
@section('title', 'Níveis de acesso dos usuários')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white ps-3 pt-2">Níveis de acesso dos usuários</h4>
            <p class="text-center text-white ps-3 pt-1 pb-3">Definir ou ajustar os níveis de acesso dos funcionário</p>
        </div>


        @if (isset($msg))
            <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                        justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5>{{ $msg }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        @if (isset($msg))
        <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                    justify-content-between align-items-end mb-3"
            role="alert" style="text-align: center;">
            <h5>{{ $msg }} </h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @endif
    
    <hr>

    <div class="row">

        <div class="col-4">

            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Nova regra</a>
        </div>

    </div>

        <hr>
            <div class="ps-3 pt-2 pb-2">
                <h4>Usuário: {{$usuario->user_name}}</h4>
                <h4>Nome: {{$usuario->name}}</h4>
            </div>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">Recurso</th>
                        <th scope="col">Permitido</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($niveis as $nivel)
                        <tr>
                            <td>{{ $usuario->id }} </td>
                            <td>{{ $usuario->name }} </td>
                            <td>{{ $usuario->user_name }} </td>
                            <td>{{ $usuario->email }} </td>

                            @if ($usuario->ativo == '1')
                                <td>Sim</td>
                            @else
                                <td>Não</td> 
                            @endif
                            
                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-success btn-sm"
                                                    title="Atualizar informações do usuário">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="{{ route('nivel_acesso.show', $usuario->id) }}" class="btn btn-info btn-sm"
                                                    title="Níveis de acesso">
                                                    <i class="bi bi-lock"></i>
                                            </a>
                                        </div>                                        

                                        <div class="col-2">

                                            <form method="POST" class="delete-form"
                                                action="{{ route('usuarios.destroy', $usuario->id) }}">
                                                @csrf
                                                {{-- o método HTTP para exclusão deve ser o DELETE --}}
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" 
                                                    title="Deletar usuãrio selecionado"
                                                    onclick="confirmDelete(this)">
                                                    <i class="bi bi-trash3-fill"></i>
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
 
            <div class="container-fluid pl-5 d-flex justify-content-center">
            {{$niveis->links('pagination::pagination')}}
            </div>            

        </div>



    </div>

@endsection
