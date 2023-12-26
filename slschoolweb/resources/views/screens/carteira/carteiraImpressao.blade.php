<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carteirinha de Estudante</title>
  <!-- Adicione os links do Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        width: 70px;
    }

    .qr{
        width: 50px;
        margin-top: 10px;
    }

    .logo{
        width: 50px;
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
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="card carteirinha">
    <div class="card-body">
      <div class="row">
        <div class="col-md-3">
          <!-- Coluna da Foto -->
          <img src="/img/aluno/{{$carteiras->alunos->foto}}" class="img-fluid foto" alt="Foto do Estudante">
          <img src="https://api.qrserver.com/v1/create-qr-code/?data=https://www.example.com/&size=100x100" 
          alt="QR Code" class="qr">
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
