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
    
    <hr>

    <div class="row">

        <hr>
            <div class="ps-3 pt-2 pb-2">
                <h4>Usuário: {{$usuario->user_name}}</h4>
                <h4>Nome: {{$usuario->name}}</h4>
            </div>

        <hr>

        <div class="card p-2 mb-4">

            <form action="/nivel_acesso_adicionar" method="post">

                @csrf

                <input type="hidden" name="userID" value="{{$usuario->id}}">

                <div class="mb-4">
                    <label for="recurso" class="form-label lblCaption">Selecione o recurso que deseja adionar</label>
                    <select class="form-control" name="recurso" id="recurso">

                        <option value="">Selecione uma opção</option>

                        @foreach ($recursos as $recurso)
                            <option value="{{$recurso}}">{{$recurso}}</option>
                        @endforeach

                    </select>
                </div>

                <button type="submit" class="btn btn-success mb-4">
                    <i class="bi bi-floppy2"></i>
                    Adicionar regra</button>

            </form>

        </div>

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

                            <td>{{ $nivel->recurso }} </td>
                            <td>{{ $nivel->permitido }} </td>
                            
                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm"
                                                    title="Bloquear acesso a este recurso">
                                                    <i class="bi bi-ban"></i>
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
