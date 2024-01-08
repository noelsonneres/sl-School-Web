@extends('layouts.main')
@section('title', 'Alunos por turmas')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Alunos por turma</h4>
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

        <div class="cardv pt-2 mt-4">
            <form action="/alunos_por_turma_listar" method="get">
                @csrf
                <div class="row">
                    <label for="selecionar" class="form-label">Selecione a turma</label>
                    <div class="col-md-9 d-flex align-items-center">
                        <select class="form-control" name="selecionar" id="selecionar">
                            @foreach ($listaTurmas as $lista)
                                <option value="{{ $lista->id }}"
                                    data-turma-info="{{ $lista->turma }} - ({{ $lista->cadastroDias->dia1 }}
                                                             {{ $lista->cadastroDias->dia2 }}) - ({{ $lista->cadastroHorarios->entrada }} {{ $lista->cadastroHorarios->saida }})"
                                    @if (request('selecionar') == $lista->id) selected @endif>
                                    {{ $lista->turma }} - ({{ $lista->cadastroDias->dia1 }}
                                    {{ $lista->cadastroDias->dia2 }}) - ({{ $lista->cadastroHorarios->entrada }}
                                    {{ $lista->cadastroHorarios->saida }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-lg">Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>

        <hr>

        <div class="card pt-3 pb-3 ps-3 mt-4 border">

            <div class="row ps-3">

                @foreach ($turmaMatriculas as $matricula)
                    <div class="col-md-3 card rounded-4 p-0 me-2 shadow" style="width: 12rem; background: #f2f2f3">

                        <a href="{{ route('matricula.show', $matricula->matriculas_id ) }}" class="link-card">

                            <div class="d-flex align-items-center justify-content-center pt-3">
                                <img src="/img/aluno/{{ $matricula->alunos->foto }}"
                                    class="card-img-top img-fluid rounded float-start" style="width: 100px" alt="...">
                            </div>

                            <div class="card-body">
                                <h5 class="card-text">Aluno(a):{{ $matricula->alunos->nome }}</h5>
                                <h5 class="card-text">Matrícula:{{ $matricula->matriculas_id }}</h5>
                            </div>
                            
                        </a>

                    </div>
                @endforeach

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selecionarElement = document.getElementById('selecionar');
            var selectedOption = selecionarElement.options[selecionarElement.selectedIndex];
            var turmaInfo = selectedOption.getAttribute('data-turma-info');

            // Faça algo com a variável 'turmaInfo', como exibi-la em algum lugar na página
            // console.log(turmaInfo);
        });
    </script>

@endsection
