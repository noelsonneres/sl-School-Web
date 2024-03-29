@extends('layout.main')
@section('title', 'Sl School - Incluir material escolar')
@section('content')

    <script src="/assets/js/masks.js"></script>

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Materiais escolares</a></li>
                            <li class="breadcrumb-item active">Incluir material escolar</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Incluir novo material escolar</h4>

                    {{-- Exibe mensagens de sucesso ou erro --}}
                    @if (isset($msg))
                        <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                                justify-content-between align-items-end mb-3"
                            role="alert" style="text-align: center;">
                            <h5>{{ $msg }} </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>
                    @endif

                    @if (isset($msgErro))
                        <div class="alert alert-danger alert-dismissible fade show msg d-flex 
                            justify-content-between align-items-end mb-3"
                            role="alert" style="text-align: center;">
                            <h5>{{ $msgErro }} </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('erro'))
                        <div class="alert alert-danger alert-dismissible fade show msg d-flex 
                    justify-content-between align-items-end mb-3"
                            role="alert" style="text-align: center;">
                            <h6 style="color: red">{{ session('erro') }}</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- Fim do bloco de mensagens e erros --}}

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Prencha os campos abaixo</h4>
                        <p class="text-muted font-14">
                            Os campos com "<span class="text-danger">*</span>" são obrigátorios
                        </p>

                        <hr>

                        <div class="card border p-2">
                            <form action="{{ route('matricula_materiais.store') }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                <input type="hidden" name="matricula" value="{{$matricula->id}}">
                                <input type="hidden" name="aluno" value="{{$matricula->alunos_id}}">
                                <input type="hidden" name="responsavel" value="{{$matricula->responsavel_alunos_id}}">

                                {{-- Info Aluno --}}
                                <div class="card mb-4 p-3">
                                    <h5 class="mb-3">Informações da matrícula</h5>
                                    <div class="row">

                                        <div class="col-md-2 mb-4">
                                            <label for="codAluno" class="form-label">Código do aluno</label>
                                            <input type="text" class="form-control" id="codAluno"
                                                value="{{ $matricula->alunos_id }}" required>
                                        </div>

                                        <div class="col-md-2 mb-4">
                                            <label for="matricula" class="form-label">Matrícula</label>
                                            <input type="text" class="form-control" id="matricula"
                                                value="{{ $matricula->id }}" readonly>
                                        </div>

                                        <div class="col-md-8 mb-4">
                                            <label for="nome" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="nome"
                                                value="{{ $matricula->alunos->nome }}">
                                        </div>

                                    </div>
                                </div>
                                {{-- Fim Info Aluno --}}

                                <div class="mb-4">
                                    <label for="material" class="form-label">Material
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="material" id="material">
                                        <option value="">Selecione uma material</option>

                                        @foreach ($listaMaterial as $lista)
                                            <option value="{{ $lista->id }}" data-valor-un={{ $lista->valor_unitario }}
                                                data-qtde={{ $lista->qtde }}>{{ $lista->material }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="valorUN" class="form-label">Valor Unitário
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control" step="0.01" min="0.01"
                                            name="valorUN" id="valorUN" required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="qtde" class="form-label">Quantidade
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control" step="1" min="1"
                                             name="qtde" id="qtde" onchange="calcular()" required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="valorTotal" class="form-label">Valor total
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control" step="0.01" min="0.01"
                                            name="valorTotal" id="valorTotal" required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="pago" class="form-label">Pago
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="pago" id="pago">
                                            <option value="">Selecione uma opcão</option>
                                            <option value="sim">Sim</option>
                                            <option value="nao">Não</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <label for="obs" class="form-label">Observação</label>
                                    <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-success">Salvar
                                        <i class="ri-save-3-fill"></i>
                                    </button>
                                    <a href="javascript:history.back()" class="btn btn-danger">Cancelar
                                        <i class=" ri-close-circle-fill"></i>
                                    </a>
                                </div>

                            </form>
                        </div>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

    {{-- Scripts --}}


    <script>

        function calcular() {
            var valorUNInput = document.getElementById("valorUN");
            var qtdeInput = document.getElementById("qtde");

            // Obter a opção selecionada no elemento select
            var materialSelect = document.getElementById("material");
            var qtdeDisponivel = $('option:selected', materialSelect).data('qtde');

            // console.log(qtdeDisponivel);

            var valorUN = parseFloat(valorUNInput.value);
            var qtde = parseFloat(qtdeInput.value);

            if(qtdeDisponivel < qtde){
                window.alert('A quantidade informada é maior do a disponível no estoque!');
                qtde = 0;
                valorUN = 0;
                document.getElementById("qtde").value = '0'; 
            }

            if (!isNaN(valorUN) && !isNaN(qtde)) {
                var resultadoDivisao = valorUN * qtde;
                document.getElementById("valorTotal").value = resultadoDivisao.toFixed(2);
            }
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#material').change(function() {
                var valor_un = $('option:selected', this).data('valor-un');
                var qtde = $('option:selected', this).data('qtde');

                if (qtde <= 0) {
                    window.alert('Não há unidade suficientes para a inclusão');
                    $('#valorUN').val(0);
                    $('#qtde').val(0);
                    $('#valorTotal').val(0);
                } else {
                    $('#valorUN').val(valor_un);
                    $('#qtde').val(1);
                    $('#valorTotal').val(valor_un);
                }

            });
        });
    </script>    

@endsection
