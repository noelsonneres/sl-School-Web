<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Recibo de pagamento</title>
    <style>
        .row-cols-3>* {
            flex: 0 0 33.33%;
            max-width: 33.33%;
        }
    </style>
</head>

<body>

    <div class="container pt-5">

        <div style="background-color: #0c6135;">
            <h4 class="text-center text-white p-1">Mensalidade quitada com sucesso!!!</h4>
        </div>


        <div class="row p-3">

            <div class="col-md-2 mb-3">
                <button class="btn btn-primary" onclick="printForm()">Impressora laser</button>
            </div>
            
            <div class="col-md-2 mb-3">
                <button class="btn btn-primary">Impressora térmica</button>
            </div>

            <div class="col-md-2 mb-3">
                <a href="{{ route('mensalidades.show', $mensalidade->matriculas_id) }}" class="btn btn-danger">
                    Voltar    
                </a>
            </div>

        </div>

        <div class="card ps-2 pe-2" id="print">

            <div class="row p-3">

                <div class="col-md-3">
                    <img src="/img/logo/{{$empresa->foto}}" alt="" width="70px">
                </div>

                <div class="col-md-9">
                    <h3>Recibo de pagamento</h3>
                    <h6>{{ $empresa->nome }} - CNPJ: {{ $empresa->cnpj }}</h6>
                    <h6>Tel: {{ $empresa->telefone }} Cel/WhatsApp: {{ $empresa->celular }}</h6>
                </div>

            </div>

            <div class="pb-3">

                <p class="border p-1 m-0" style="font-size: 12px">Aluno(a): {{ $aluno->nome }}</p>
                <p class="border p-1 m-0" style="font-size: 12px">Código: {{ $aluno->id }} | Matrícula:
                    {{ $mensalidade->matriculas_id }}</p>
                <p class="border p-1 m-0" style="font-size: 12px">Mensalidade: {{ $mensalidade->id }} |
                    <span style="font-weight: 600" style="font-size: 12px">Valor: R$
                        {{ number_format($mensalidade->valor_parcela, '2', ',', '.') }}</span>
                    | <span style="font-weight: 600" style="font-size: 12px">Vencimento:
                        {{ date('d/m/Y', strtotime($mensalidade->vencimento)) }}</span>
                </p>
                <p class="border p-1 m-0" style="font-size: 12px">Juros:
                    {{ number_format($mensalidade->juros, '2', ',', '.') }} |
                    Multa: {{ number_format($mensalidade->multa, '2', ',', '.') }} |
                    Desconto: {{ number_format($mensalidade->desconto, '2', ',', '.') }} |
                    Acrésimo: {{ number_format($mensalidade->juros, '2', ',', '.') }} |
                    <span style="font-weight: 600">Total: R$
                        {{ number_format($mensalidade->valor_pago, '2', ',', '.') }} </span>
                </p>
                <p class="border p-1 m-0" style="font-size: 12px"><span style="font-weight: 600">Data de pagamento:
                        {{ date('d/m/Y', strtotime($mensalidade->data_pagamento)) }}</span>  |  
                    <span style="font-weight: 800">Pago: {{ $mensalidade->pago }}</span> | 
                        Forma de pagamento: {{ $mensalidade->forma_pagamento }}
                </p>
                <p class="border p-1 m-0" style="font-size: 12px">
                    Responsável pelo pagamento: {{ $mensalidade->forma_pagamento }}
                </p>
                <p class="border p-1 m-0" style="font-size: 12px">
                    Observação: {{ $mensalidade->observacao }}
                </p>
                <br>
                <p>Assinatura ___________________________________________</p>

            </div>

            <p>-------------------------------------------------------------------------</p>

            <div class="row p-3">

                <div class="col-md-3">
                    <img src="/img/logo/{{$empresa->foto}}" alt="" width="70px">
                </div>

                <div class="col-md-9">
                    <h3>Recibo de pagamento</h3>
                    <h6>{{ $empresa->nome }} - CNPJ: {{ $empresa->cnpj }}</h6>
                    <h6>Tel: {{ $empresa->telefone }} Cel/WhatsApp: {{ $empresa->celular }}</h6>
                </div>

            </div>


            <div class="pb-3">

                <p class="border p-1 m-0" style="font-size: 12px">Aluno(a): {{ $aluno->nome }}</p>
                <p class="border p-1 m-0" style="font-size: 12px">Código: {{ $aluno->id }} | Matrícula:
                    {{ $mensalidade->matriculas_id }}</p>
                <p class="border p-1 m-0" style="font-size: 12px">Mensalidade: {{ $mensalidade->id }} |
                    <span style="font-weight: 600" style="font-size: 12px">Valor: R$
                        {{ number_format($mensalidade->valor_parcela, '2', ',', '.') }}</span>
                    | <span style="font-weight: 600" style="font-size: 12px">Vencimento:
                        {{ date('d/m/Y', strtotime($mensalidade->vencimento)) }}</span>
                </p>
                <p class="border p-1 m-0" style="font-size: 12px">Juros:
                    {{ number_format($mensalidade->juros, '2', ',', '.') }} |
                    Multa: {{ number_format($mensalidade->multa, '2', ',', '.') }} |
                    Desconto: {{ number_format($mensalidade->desconto, '2', ',', '.') }} |
                    Acrésimo: {{ number_format($mensalidade->juros, '2', ',', '.') }} |
                    <span style="font-weight: 600">Total: R$
                        {{ number_format($mensalidade->valor_pago, '2', ',', '.') }} </span>
                </p>
                <p class="border p-1 m-0" style="font-size: 12px"><span style="font-weight: 600">Data de pagamento:
                        {{ date('d/m/Y', strtotime($mensalidade->data_pagamento)) }}</span> |
                        <span style="font-weight: 800">Pago: {{ $mensalidade->pago }}</span>  | Forma de pagamento: {{ $mensalidade->forma_pagamento }}
                </p>
                <p class="border p-1 m-0" style="font-size: 12px">
                    Responsável pelo pagamento: {{ $mensalidade->forma_pagamento }}
                </p>
                <p class="border p-1 m-0" style="font-size: 12px">
                    Observação: {{ $mensalidade->observacao }}
                </p>
                <br>

                <p>Assinatura ___________________________________________</p>

            </div>

        </div>

    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
        function printForm() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

</body>

</html>
