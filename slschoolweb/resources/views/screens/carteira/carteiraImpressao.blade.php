<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carteirinha de Estudante</title>
  <!-- Adicione os links do Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="\js\jquery.min.js"></script>
    <script src="\js\qrcode.js"></script>

  <style>
    /* Estilo Personalizado para a Carteirinha */
    .carteirinha {
      width: 400px; /* Largura da carteirinha */
      height: 190px; /* Altura da carteirinha */
    }

    .texto{
        margin-bottom: 2px;
        font-size: 16px;
    }

    .texto_empresa{
        margin-bottom: 2px;
        font-size: 12px;
    }

    .texto_mensagem{
        padding: 0;
        font-size: 11px;
    }

    .foto{
        width: 80px;
    }

    .qr{
        width: 50px;
        margin-top: 10px;
    }

    .logo{
        width: 50px;
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

    /* Estilo de Impressão */
    @media print {
      body, html {
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
    Ao Imprimir a carteirinha certifique-se se a impressão está ajustada à página para o modo paisagem
    <br>
    <br>
    <button class="btn-impress" onclick="window.print()">Imprimir</button>    &nbsp;
    &nbsp    &nbsp;    &nbsp;
    <button class="btn-voltar" onclick="window.history.back()">Voltar</button>

</div>

<div class="container mt-5">
  <div class="card carteirinha">
    <div class="card-body">
      <div class="row">
        <div class="col-md-3">
          <!-- Coluna da Foto -->

            @if($carteiras->alunos->foto != null)
                <img src="/img/aluno/{{$carteiras->alunos->foto}}" class="img-fluid foto" alt="Foto do Estudante">
            @else
                <img src="/img/carteira/default.jpg" class="img-fluid foto" alt="Foto do Estudante">
            @endif

            <div id="test" class="qr">

                <script>

                    var info = 'Nome: '+'{{$carteiras->alunos->nome}}\n' +
                                'Matricula: '+'{{$carteiras->matriculas_id}}\n'+
                                'Validade. Doc: '+ '{{date('d/m/Y', strtotime($carteiras->Validade))}}';

                    var qrcode = new QRCode("test", {
                        text: info,
                        width: 80,
                        height: 80,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                </script>

            </div>



        </div>
        <div class="col-md-9">
          <!-- Coluna das Informações do Estudante -->
          <h5>{{$carteiras->alunos->nome}}</h5>
          <p class="texto">Matrícula: {{$carteiras->matriculas_id}}</p>
          <p style="font-size: 14px; margin-bottom: 2px">Curso: {{$carteiras->matriculas->cursos->curso}}</p>

          <!-- Informações da Escola -->

          <div class="card p-2 mt-2">
            <p class="texto_empresa">{{$empresa->nome}}</p>
            <p class="texto_empresa">{{$empresa->cnpj}}</p>
            <p class="texto_empresa">Tel/Cel {{$empresa->telefone}} - {{$empresa->celular}}</p>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Verso da Carteirinha -->
  <div class="card mt-3 carteirinha">
    <div class="card-body">
      <!-- Mensagem Personalizada e Logo da Escola -->
        <p class="texto_mensagem">
            {{$carteiras->mensagem}}
          </p>

      <div class="card border p-1">
        <p class="texto">Gerado em: {{date('d/m/Y', strtotime($carteiras->data_impressao))}}
                     -  Valido até: {{date('d/m/Y', strtotime($carteiras->Validade))}} </p>
      </div>
      <div class="d-flex justify-content-end">
        <img src="/img/carteira/{{$confCarteira->logo}}" class="img-fluid logo" alt="Logo da Escola">
      </div>
    </div>
  </div>
</div>

<!-- Adicione os scripts do Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
