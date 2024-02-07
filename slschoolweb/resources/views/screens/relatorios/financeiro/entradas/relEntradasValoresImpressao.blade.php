<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações Entrada de Valores</title>
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
        }

        .col-md-10 {
            flex: 1;
        }

        .cabecalho {
            width: 400px;
            height: 190px;
        }

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
            <h1>Informações Entrada de Valores</h1>
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

        {{-- Informações da conta --}}

        <table class="table table-bordered table-responsive">

            <tr>
                <td>Código: {{$entrada->id}}</td>
                <td colspan="2">Motivo: {{$entrada->motivo}}</td>
            </tr>

            <tr>
                <td>Data: {{date('d/m/Y', strtotime($entrada->data))}}</td>
                <td>Hora: {{$entrada->hora}}</td>
                <td>Valor: R$ {{number_format( $entrada->valor, 2, ',', '.') }}</td>
            </tr>

            <tr>
                <td colspan="3">Observação: {{$entrada->observacao}}</td>
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
