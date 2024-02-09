<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório do aluno</title>
    <!-- Adicione os links do Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="\js\jquery.min.js"></script>
    <script src="\js\qrcode.js"></script>

    <style>
        .foto {
            width: 80px;
        }

        .qr {
            width: 50px;
            margin-top: 10px;
        }

        .logo {
            width: 100px;
            /* Ajuste a largura conforme necessário */
            height: auto;
        }

        .dados {
            padding-left: 20px;
            /* Ajuste o espaçamento conforme necessário */
        }

        .bto {
            padding: 1%;
            background: #dedede;
            margin-bottom: 1%;
            border-bottom: 1px solid #ccc;
        }

        .bto a,
        .bto button {
            padding: 9px;
            border: 0;
            cursor: pointer;
            text-decoration: none;
            font-size: 1em;
        }

        .bto .btn-impress {
            color: #fff;
            background: green;
        }

        .bto .btn-capa {
            color: #fff;
            background: rgb(0, 13, 128);
        }

        .bto .btn-voltar {
            color: #fff;
            background: rgb(242, 4, 4);
        }

        .bto .btn {
            color: #555;
            background: transparent;
        }

        .col-md-2 {
            flex: 0 0 auto;
            /* Tamanho automático com base no conteúdo */
        }

        .col-md-10 {
            flex: 1;
            /* Expande para ocupar o restante da largura disponível */
        }

        .cabecalho {
            width: 400px;
            /* Largura da carteirinha */
            height: 190px;
            /* Altura da carteirinha */
        }

        /* Estilo de Impressão */
        @media print {

            body,
            html {
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
            }

            .carteirinha {
                page-break-inside: avoid;
                page-break-before: auto;
                page-break-after: auto;
            }

            .bto {
                display: none;
            }

            .quebra-pagina {
                page-break-after: always;
            }

        }
    </style>
</head>

<body>

    <div class="bto">
        <button class="btn-impress" onclick="window.print()">Imprimir</button> &nbsp;
        &nbsp &nbsp; &nbsp;
        <button class="btn-voltar" onclick="window.history.back()">Voltar</button>

    </div>

    <div class="container mt-5">

        <header class="mb-4">
            <h1>Relatório do Aluno</h1>
        </header>


        {{-- Informações da empresa --}}

        <table class="table border">
            <tr>
                <td>
                    <div class="col-md-2">
                        <img src="/img/logo/{{ $empresa->foto }}" alt="" class="logo">
                    </div>
                </td>
                <td>
                    <div class="col-md-10 text-end">
                        <h4>{{ $empresa->nome }}</h4>
                        <h6>{{ $empresa->cnpj }}</h6>
                        <h6>Tel: {{ $empresa->telefone }}- Cel/WhatsApp: {{ $empresa->celular }}</h6>
                        {{-- <h6>Endereço: {{ $empresa->endereco }} {{ $empresa->bairro }},
                            {{ $empresa->numero }} {{ $empresa->cep }} {{ $empresa->cidade }} - {{ $empresa->estado }}</h6> --}}
                    </div>
                </td>
            </tr>
        </table>

        <hr>

        <div class="mb-2 mt-2 float-end pe-5">
            <img src="/img/aluno/{{ $aluno->foto }}" alt="" class="foto rounded-circle">
        </div>

        {{-- Informações do aluno --}}

        <table class="table table-bordered table-responsive">

            <tr>
                <td colspan="1">Código: {{ $aluno->id }}</td>
                <td colspan="2">Nome: {{ $aluno->nome }} </td>
                <td colspan="1">Apelido: {{ $aluno->apelido }}</td>
            </tr>

            <tr>
                <td colspan="1">Dt nascimento: {{ date('d/m/Y', strtotime($aluno->data_nascimento)) }}</td>
                <td>Dt cadastro: {{ date('d/m/Y', strtotime($aluno->data_cadastro)) }}</td>
                <td>CPF: {{ $aluno->cpf }}</td>
                <td>RG: {{ $aluno->rg }}</td>
            </tr>

            <tr>
                <td colspan="2">Fobias: {{ $aluno->fobias }}</td>
                <td colspan="2">Alergias: {{ $aluno->alergias }}</td>
            </tr>

            <tr>
                <td colspan="2">Deficiencias: {{ $aluno->deficiencias }}</td>
                <td colspan="2">outros_aspectos: {{ $aluno->deficiencias }}</td>
            </tr>

            <tr>
                <td colspan="2">Endereço: {{ $aluno->endereco }}</td>
                <td colspan="2">Bairro: {{ $aluno->bairro }}</td>
            </tr>

            <tr>
                <td colspan="2">Complemento: {{$aluno->complemento}}</td>
                <td>Número: {{$aluno->numero}}</td>
                <td>CEP: {{$aluno->cep}}</td>
            </tr>

            <tr>
                <td colspan="3">Cidade: {{$aluno->cidade}}</td>
                <td>Estado: {{$aluno->estado}}</td>
            </tr>

            <tr>
                <td>Telefone: {{$aluno->telefone}}</td>
                <td>Celular: {{$aluno->celular}}</td>
                <td colspan="2">E-Mail: {{$aluno->email}}</td>
            </tr>

            <tr>
                <td>Estado civil: {{$aluno->estado_civil}}</td>
                <td colspan="2">Profissão: {{$aluno->profissao}}</td>
                <td>Nacionalidade: {{$aluno->nacionalidade}}</td>
            </tr>

            <tr>
                <td colspan="2">Nome da mãe: {{$aluno->nome_mae}}</td>
                <td>RG mãe: {{$aluno->rg_mae}}</td>
                <td>CPF mãe: {{$aluno->cpf_mae}}</td>
            </tr>

            <tr>
                <td colspan="2">Nome do pai: {{$aluno->nome_pai}}</td>
                <td>RG mãe: {{$aluno->rg_pai}}</td>
                <td>CPF mãe: {{$aluno->cpf_pai}}</td>
            </tr>  
            
            <tr>
                <td>Ativo: {{$aluno->ativo}}</td>
                <td colspan="3">Observação: {{$aluno->observacao}}</td>
            </tr>

        </table>

      </div>

        <footer class="mb-5">
            {{-- <p>Este é um relatório gerado em HTML.</p> --}}
        </footer>

        <!-- Adicione os scripts do Bootstrap 5 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
