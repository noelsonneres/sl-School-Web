@extends('layouts.main')
@section('title', 'Visualizar ou atualizar informações do responsável')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Visualizar ou atualizar informações do responsável</h3>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-8">
                <div class="row">

                    <div class="col-md-3">
                        <a href="/home_aluno" title="Voltar para a página anterior" 
                            class="btn btn-success d-block mb-2">
                            <i class="bi bi-arrow-left-circle-fill"></i>
                            Lista de alunos
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="javascript:history.back()" title="Visualizar ou criar uma matrícula" class="btn btn-info d-block mb-2">                
                            <i class="bi bi-folder-plus"></i>
                            Matrículas
                        </a>
                    </div>
                
                    <div class="col-md-2">
                        <form method="POST" class="delete-form" action="{{ route('responsavel.destroy', $responsavel->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">
                                <i class="bi bi-trash3-fill"></i>
                                Excluir
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
        
        </div>   
    
        <hr>
            <h4 class="ps-3">Aluno(a): {{$aluno->nome}}</h4>
        <hr>

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

            <h4>Informações do responsável</h4>
            <hr>

            <form action="{{ route('responsavel.update', $responsavel->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                    <input type="hidden" name="idAluno" name="idAluno" value="{{$aluno->id}}">

                    <div class="row">

                        <div class="col-md-8 mb-3">
                            <label for="nome" class="form-label lblCaption">Nome completo</label>
                            <input type="text" class="form-control" name="nome" id="nome"
                                placeholder="Digite o nome do responsável" autofocus required 
                                    maxlength="100" value="{{$responsavel->nome}}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="apelido" class="form-label lblCaption">Apelido</label>
                            <input type="text" class="form-control" name="apelido" id="apelido"
                                maxlength="50" value="{{$responsavel->apelido}}">
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label for="dataNascimento" class="form-label lblCaption">Data de nascimento</label>
                            <input type="date" class="form-control" name="dataNascimento" id="dataNascimento"
                                value="{{$responsavel->data_nascimento}}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="dataCadatro" class="form-label lblCaption">Data de cadastro</label>
                            <input type="date" class="form-control" name="dataCadatro" id="dataCadatro"
                                 value="{{$responsavel->data_cadastro}}">                            
                        </div>                        

                        <div class="col-md-3 mb-3">
                            <label for="cpf" class="form-label lblCaption">RG</label>
                            <input type="text" class="form-control" id="rg" name="rg"
                                value="{{$responsavel->rg}}">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="cpf" class="form-label lblCaption">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf"
                                value="{{$responsavel->cpf}}">                            
                        </div>                        

                    </div>

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label for="cep" class="form-label lblCaption">CEP</label>
                            <input type="text" class="form-control" class="cep" name="cep"
                                 id="cep" value="{{$responsavel->cep}}">
                        </div>

                        <div class="col-md-9 mb-3">
                            <label for="endereco" class="form-label lblCaption">Endereço</label>
                            <input type="text" class="form-control" name="endereco" id="endereco"
                                maxlength="100" value="{{$responsavel->endereco}}">
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-5 mb-3">
                            <label for="bairro" class="form-label lblCaption">Bairro</label>
                            <input type="text" class="form-control" name="bairro" id="bairro" 
                                maxlength="50" value="{{$responsavel->bairro}}">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="numero" class="form-label lblCaption">Número</label>
                            <input type="numeber" class="form-control" name="numero" id="numero"
                                value="{{$responsavel->numero}}">
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="complemento" class="form-label lblCaption">Complemento</label>
                            <input type="text" class="form-control" name="complemento" id="complemento" 
                                maxlength="50" value="{{$responsavel->complemento}}">
                        </div>                        

                    </div>

                    <div class="row">

                        <div class="col-md-9 mb-3">
                            <label for="cidade" class="form-label lblCaption">Cidade</label>
                            <input type="text" class="form-control" name="cidade" id="cidade" 
                                maxlength="50" value="{{$responsavel->cidade}}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="estado" class="form-label lblCaption">Estado</label>
                            <input type="text" class="form-control" name="estado" id="estado" 
                                maxlength="2" value="{{$responsavel->estado}}">
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label for="telefone" class="form-label lblCaption">Telefone</label>
                            <input type="tel" class="form-control" name="telefone" id="telefone"
                                value="{{$responsavel->telefone}}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="celular" class="form-label lblCaption">Celular</label>
                            <input type="tel" class="form-control" name="celular" id="celular"
                                value="{{$responsavel->celular}}">  
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label lblCaption">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email"
                                maxlength="100" value="{{$responsavel->email}}">    
                        </div>                        

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="estadoCivil" class="form-label lblCaption">Estado civil</label>
                            <input type="text" class="form-control" name="estadoCivil" id="estadoCivil"
                                maxlength="20" value="{{$responsavel->estado_civil}}">                             
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="profissao" class="form-label lblCaption">Profissão</label>
                            <input type="text" class="form-control" name="profissao" id="profissao" 
                                value="{{$responsavel->profissao}}">                                
                        </div>                        

                    </div>

                    <div class="mb-4">
                        <label for="obs" class="form-label lblCaption">Observação</label>
                        <input type="text" class="form-control" name="obs" id="obs"
                            value="{{$responsavel->observacao}}">    
                    </div>

                    <div class="mb-4">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="foto">Selecione uma foto</label>
                            <input type="file" class="form-control" name="foto" id="foto"
                                onchange="exibirFotoSelecionada()">
                        </div>
                        <img id="imagemSelecionada" class="img-thumbnail" alt="" width="250px"
                            src="/img/responsavel/{{$responsavel->foto}}">
                    </div>                    

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/home_aluno" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>


    <script>
        function exibirFotoSelecionada() {
            const input = document.getElementById("foto");
            const imagem = document.getElementById("imagemSelecionada");
    
            if (input.files && input.files[0]) {
                const leitor = new FileReader();
    
                leitor.onload = function(e) {
                    imagem.src = e.target.result;
                };
    
                leitor.readAsDataURL(input.files[0]);
            }
        }
    </script>    
    
    
    {{-- PROCESSO DE VALIDAÇÃO DO CAMPOS --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    
    <!-- Inclua o InputMask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    
    <script>
        // Aplicar a máscara de telefone usando InputMask
        $(document).ready(function() {
            $('#telefone').inputmask('(99) 9 9999-9999');
            $('#celular').inputmask('(99) 9 9999-9999');
            $('#cep').inputmask('99999-999');
            $('#cpf').inputmask('999.999.999-99');
    
            $('#cpfMae').inputmask('999.999.999-99');
            $('#cpfPai').inputmask('999.999.999-99');
        });
    </script>
    
    <!-- ViaCEP -->
    
    
    <!-- Adicionando Javascript -->
    <script>
        $(document).ready(function() {
    
            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
            }
    
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {
    
                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');
    
                //Verifica se campo cep possui valor informado.
                if (cep != "") {
    
                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;
    
                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {
    
                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#endereco").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#estado").val("...");
    
                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
    
                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#endereco").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#estado").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>    

@endsection
