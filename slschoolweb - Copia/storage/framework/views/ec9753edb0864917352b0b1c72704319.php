
<!DOCTYPE HTML>
<!-- SPACES 2 -->
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="Resource-type" content="document">
    <meta name="Robots" content="all">
    <meta name="Rating" content="general">
    <meta name="author" content="Gabriel Masson">
    <title>Capa do Carnê</title>
    <link href="img/favicon.png" rel="shortcut icon" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>

  <style>
    body {
        margin: 0;
    }

    .grid {
        width: 100%;
        position: relative;
        overflow: hidden;
        zoom: 1;
    }

    .grid:before,
    .grid:after {
        content: "";
    }

    .grid:after {
        clear: both;
    }

    .grid>div[class*="col"],
    .grid>div[class*="size"],
    .grid>div[class*="w"],
    .grid>div[class*="px"] {
        float: left;
        vertical-align: middle;
    }

    .col12 {
        width: 100%;
    }

    .col12-pad {
        width: 98%;
        padding: 1%;
    }

    .col11 {
        width: 91.66%;
    }

    .col11-pad {
        width: 89.66%;
        padding: 1%;
    }

    .col10 {
        width: 83.33%;
    }

    .col10-pad {
        width: 81.33%;
        padding: 1%;
    }

    .col9 {
        width: 75%;
    }

    .col9-pad {
        width: 73%;
        padding: 1%;
    }

    .col8 {
        width: 66.66%;
    }

    .col8-pad {
        width: 64.66%;
        padding: 1%;
    }

    .col7 {
        width: 58.33%;
    }

    .col7-pad {
        width: 56.33%;
        padding: 1%;
    }

    .col6 {
        width: 50%;
    }

    .col6-pad {
        width: 48%;
        padding: 1%;
    }

    .col5 {
        width: 41.66%;
    }

    .col5-pad {
        width: 39.66%;
        padding: 1%;
    }

    .col4 {
        width: 33.33%;
    }

    .col4-pad {
        width: 31.33%;
        padding: 1%;
    }

    .col3 {
        width: 25%;
    }

    .col3-pad {
        width: 23%;
        padding: 1%;
    }

    .col2 {
        width: 16.66%;
    }

    .col2-pad {
        width: 14.66%;
        padding: 1%;
    }

    .col1 {
        width: 8.333%;
    }

    .col1-pad {
        width: 6.333%;
        padding: 1%;
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

    table td {
        padding: 5px 12px;
        margin: 0;
        border-top: 1px solid #333;
    }

    table,
    table tr {
        margin: 0;
        padding: 0;
    }

    .parcela {
        padding: 2% 0 2% 2%;
        border-top: 1px dashed #333;
        border-bottom: 1px dashed #333;
        font-size: .9em;
    }

    .destaca {
        padding-right: 3%;
        margin-right: 3%;
        border-right: 1px dashed #333;
    }

    .text-center {
        text-align: center;
    }

    .nome {
        /* Nome no carnê */
        padding-top: 2%;
        font-size: .7em;
    }


    @media print {
        .bto {
            display: none;
        }

        .quebra-pagina {
            page-break-after: always;
        }
    }


    /* ------------------------------------ */

    .capa {
        height: 250px;
        width: 96%;
        padding: 2%;
        border-top: 1px dashed #333;
        border-bottom: 1px dashed #333;
        font-size: 1.1em;
        margin-top: 7%;
    }

    .capa img {
        max-width: 100%;
        height: 180px;
    }
</style>

  <body>
  <div class="bto">
    Ao Imprimir o carnê certifique-se se a impressão está ajustada à página
    <br>
    <br>
    <button class="btn-impress" onclick="window.print()">Imprimir</button>
    <button class="btn-voltar" onclick="window.history.back()">Voltar</button>
  </div>

  <div class="capa">
    <div class="grid">
      <div class="col4" style="padding-top: 70px">
        <img src="/img/logo/<?php echo e($empresa->foto); ?>" style="height: 100px">
      </div>
      <div class="col8" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0">
        <h2>Carnê de Pagamento</h2>
        <h3><?php echo e($empresa->nome); ?></h3>
        <p><?php echo e($empresa->endereco); ?>, <?php echo e($empresa->bairro); ?>, <?php echo e($empresa->numero); ?>, 
            <?php echo e($empresa->cep); ?>, <?php echo e($empresa->cidade); ?> - <?php echo e($empresa->estado); ?></p>
        <p>Telefone: <?php echo e($empresa->telefone); ?> Celular: <?php echo e($empresa->celular); ?></p>    
        
      </div>
    </div>
  </div>

  </body>
</html><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/mensalidade/mensalidadesCapa.blade.php ENDPATH**/ ?>