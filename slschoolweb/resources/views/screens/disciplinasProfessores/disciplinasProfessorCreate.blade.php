@extends('layouts.main')
@section('title', 'Incluir nova disciplina')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Incluir nova disciplina</h3>
        </div>

        <hr>
            <h5>Professor(a): {{$professor->nome}}</h5>

        @if (isset($msg))
            <hr>
            <div class="alert alert-warning alert-dismissible fade show msg d-flex 
							justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5>{{ $msg }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        <hr>

        <div class="card p-5">

            <form action="{{ route('professor_disciplina.store') }}" method="post" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="professor" value="{{$professor->id}}">
                <div class="mb-4">
                    <label for="disciplina" class="form-label lblCaption">Disciplina</label>
                    <select name="opt" id="opt" class="form-control">
                        <option value="">Selecione uma disciplina</option>

                        @foreach($disciplinas as $disciplina)

                            <option value="{{$disciplina->id}}">{{$disciplina->disciplina}}</option>

                        @endforeach

                    </select>
                </div>


                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/professores" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
