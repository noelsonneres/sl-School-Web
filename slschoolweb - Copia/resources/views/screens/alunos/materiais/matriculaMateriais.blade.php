
@extends('layouts.main')
@section('title', 'Lista dos materiais')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Lista dos materiais escolares</h3>
    </div>
    
    @if(isset($msg))
    <div class="alert alert-warning alert-dismissible fade show msg d-flex 
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
        <h5>{{$msg}} </h5>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
    @endif

    <hr>

    <div class="row">

        <div class="col-4">

            <a href="{{'/matricula_materiais_adicionar/'.$matricula->id}}"class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Incuir material </a>           

                <a href="{{'/matricula_material_parcelas/'.$matricula->id}}"class="btn btn-success" 
                title="Gerar parcelas" >
                    <i class="bi bi-currency-dollar"></i>
                    Gerar parcelas </a>                

            <button onclick="(print())" class="btn $teal-300">Imprimir</button>

        </div>     

    </div>

    <hr>

    <h4 class="m-3">Aluno(a): {{$aluno->nome}}</h4>
    <h5 class="m-3">Matricula: {{$matricula->id}} </h5>

    <hr>

    <div class="card pt-2 mt-4">


        <table class="table p-1">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Material</th>
                    <th scope="col">Valor UN</th>
                    <th scope="col">Qtde</th>
                    <th scope="col">Valor total</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($materiais as $material)

                <tr>
                    <td>{{$material->id}} </td>
                    <td>{{ Str::substr($material->material->material, 0, 30)}} </td>
                    <td>R$ {{number_format($material->valor_un, 2, ',', '.')}} </td>
                    <td>{{$material->qtde}} </td>
                    <td>R$ {{number_format($material->valor_total, 2, ',', '.')}} </td>

                    <td>

                            <div class="row">                          

                                <div class="col-2">
                                    <a href="{{('/matricula_material_parcela/'.$material->matriculas_id.'/'.$material->id) }}" 
                                           title="Gerar parcela apenas deste" class="btn btn-success btn-sm">
                                           <i class="bi bi-card-list"></i>
                                    </a>
                                </div>

                                <div class="col-3">

                                    <form method="POST" class="delete-form"
                                        action="{{ route('matricula.destroy', $matricula->id) }}">
                                        @csrf
                                        {{-- o método HTTP para exclusão deve ser o DELETE --}}
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
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

                    </td>
                </tr>

                @endforeach                
               
            </tbody>
        </table>

        <div class="row">
            <div>
                {{ $materiais->links('pagination::pagination') }}
            </div>
        </div>

    </div>

</div>

@endsection