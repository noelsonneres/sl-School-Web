@extends('layouts.main')
@section('title', 'Novo plano de contas')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Novo plano de contas</h3>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <hr>

        <div class="card p-5">

            <form action="{{ route('plano_contas.update', $plano->id) }}" method="post">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="plano" class="form-label lblCaption">Plano de contas</label>
                    <input type="text" class="form-control" name="plano" id="plano"
                           value="{{$plano->plano}}" required maxlength="50">
                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/config_mensalidades" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
