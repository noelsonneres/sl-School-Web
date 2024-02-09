@extends('layouts.main')
@section('title', 'Atualizar informações do usuário')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Atualizar informações do usuário</h3>
        </div>

        @if (isset($msg))
        <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                    justify-content-between align-items-end mb-3"
            role="alert" style="text-align: center;">
            <h5>{{ $msg }} </h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    @if(session('erro'))
        <div class="alert alert-danger alert-dismissible fade show msg d-flex 
        justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
           <h6 style="color: red">{{ session('erro') }}</h6> 
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        <hr>

        <div class="card p-5">

            <form action="{{ route('usuarios.update', $usuario->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card border p-3 mb-4">

                    <div class="row">

                        <div class="col-md-4">
                            <label for="nome" class="form-label lblCaption">Nome *</label>
                            <input type="text" class="form-control" name="nome" id="nome" 
                                required maxlength="100" autocomplete="off"
                                    value="{{$usuario->name}}">
                        </div>
    
                        <div class="col-md-4">
                            <label for="usuario" class="form-label lblCaption">Usuario *</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" 
                                        required maxlength="20" value="{{$usuario->user_name}}" autocomplete="off">
                        </div>               
                        
                        <div class="col-md-2">
                            <label for="senha" class="form-label lblCaption">Senha *</label>
                            <input type="password" class="form-control" name="senha" id="senha" 
                                minlength="6" maxlength="255" autocomplete="off">
                        </div>
                        
                        <div class="col-md-2">
                            <label for="confirmarSenha" class="form-label lblCaption">Confirmar senha</label>
                            <input type="password" class="form-control" name="confirmarSenha" 
                                    id="confirmarSenha"  minlength="6" maxlength="255" autocomplete="off">
                        </div>
    
                    </div>  
                    
                    <div class="md-4 mt-4">
                        <label for="email" class="form-label lblCaption">E-mail *</label>
                        <input type="email" class="form-control" name="email" id="email" 
                            required maxlength="100" value="{{$usuario->email}}" autocomplete="off">
                    </div>

                </div>

                <div class="card border mb-4 p-3">

                    <div class="row">

                        <div class="col-md-4">
                            <label for="cpf" class="form-label lblCaption">CPF</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" 
                               value="{{$usuario->documento}}" autocomplete="off">
                        </div>

                        <div class="col-md-2">
                            <label for="ativo" class="form-label lblCaption">Ativo</label>
                            <select class="form-control" name="ativo" id="ativo">
                                @if ($usuario->ativo = '1')
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                @else
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="admissao" class="form-label lblCaption">Data de admissão</label>
                            <input type="date" class="form-control" name="admissao" id="admissao" 
                                value="{{$usuario->data_admissao}}">
                        </div>

                        <div class="col-md-3">
                            <label for="desligamento" class="form-label lblCaption">Data de desligamento</label>
                            <input type="date" class="form-control" name="desligamento" id="desligamento" 
                                value="{{$usuario->data_desligamento}}">                         
                        </div>                        

                    </div>

                </div>

                <div class="card border p-3 mb-4">

                    <div class="row mb-4">

                       <div class="col-md-6">
                            <label for="telefone" class="form-label lblCaption">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="telefone"
                                 autocomplete="off" value="{{$usuario->telefone}}">
                        </div> 

                        <div class="col-md-6">
                            <label for="celular" class="form-label lblCaption">Celular</label>
                            <input type="text" class="form-control" name="celular" id="celular"
                                 autocomplete="off" value="{{$usuario->celular}}">
                        </div>                         

                    </div>

                    <div class="row mb-4">

                        <div class="col-md-3">
                            <label for="cep" class="form-label lblCaption">CEP</label>
                            <input type="text" class="form-control" name="cep" id="cep"
                                 autocomplete="off" value="{{$usuario->cep}}">
                        </div>

                        <div class="col-md-9">
                            <label for="endereco" class="form-label lblCaption">Endereço</label>
                            <input type="text" class="form-control" name="endereco" id="endereco"
                               value="{{$usuario->endereco}}"  autocomplete="off">
                        </div>

                    </div>

                    <div class="row mb-4">
                       
                        <div class="col-md-6">
                            <label for="bairro" class="form-label lblCaption">Bairro</label>
                            <input type="text" class="form-control" name="bairro" id="bairro" 
                               value="{{$usuario->bairro}}" autocomplete="off">
                        </div>

                        <div class="col-md-4">
                            <label for="complemento" class="form-label lblCaption">Complemento</label>
                            <input type="text" class="form-control" name="complemento" id="complemento" 
                               value="{{$usuario->complemento}}" autocomplete="off">
                        </div>

                        <div class="col-md-2">
                            <label for="numero" class="form-label lblCaption">Número</label>
                            <input type="text" class="form-control" name="numero" id="numero" 
                               value="{{$usuario->numero}}" autocomplete="off">                            
                        </div>
                        
                    </div>

                    <div class="row mb-4">

                        <div class="col-md-9">
                            <label for="cidade" class="form-label lblCaption">Cidade</label>
                            <input type="text" class="form-control" name="cidade" id="cidade" maxlength="100"
                               value="{{$usuario->cidade}}"  autocomplete="off">
                        </div>

                        <div class="col-md-3">
                            <label for="estado" class="form-label lblCaption">Estado</label>
                            <input type="text" class="form-control" name="estado" id="estado"
                                value="{{$usuario->estado}}" autocomplete="off">
                        </div>

                    </div>

                    <div class="mb-4">
                        <label for="obs" class="form-label lblCaption">Observação</label>
                        <input type="text" class="form-control" name="obs" id="obs" maxlength="255" 
                           value="{{$usuario->observacao}}" autocomplete="off">
                    </div>

                    <div class="mb-4">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="foto">Selecione uma foto</label>
                            <input type="file" class="form-control" name="foto" id="foto"
                                onchange="exibirFotoSelecionada()">
                        </div>
                        <img id="imagemSelecionada" class="img-thumbnail" alt="" width="250px"
                            src="/img/user/{{$usuario->foto}}">
                    </div>                    

                </div>
                
                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="javascript:history.back()" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

    <script>
    
    //     let senha = document.getElementById('senha');
    //     let senhaC = document.getElementById('confirmarSenha');

    //     function validarSenha() {
    //     if (senha.value != senhaC.value) {
    //         senhaC.setCustomValidity("Senhas diferentes!");
    //         console.log("Senhas diferentes!");
    //         senhaC.reportValidity();
    //         return false;
    //     } else {
    //         senhaC.setCustomValidity("");
    //         return true;
    //      }
    // }
        // verificar também quando o campo for modificado, para que a mensagem suma quando as senhas forem iguais
        // senhaC.addEventListener('input', validarSenha);

    </script>


{{-- Localiza a foto do professor --}}

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
<!-- Adicionando JQuery -->
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
