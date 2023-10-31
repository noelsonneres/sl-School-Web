
@extends('layouts.main')
@section('title', 'Novo curso')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Incluir um novo curso</h3>
    </div>

    <hr>

    <div class="card p-5">

        <form action="{{route('cursos.store')}}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="mb-4">
                <label for="disciplina" class="form-label">Selecione a disciplina</label>
                <select name="disciplina" id="disciplina" class="form-control">
                    <option value="">Selecione uma disciplina</option>    

                    @foreach ($disciplinas as $disciplina)
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