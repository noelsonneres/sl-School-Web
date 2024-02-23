<!DOCTYPE HTML>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="Resource-type" content="document">
    <meta name="Robots" content="all">
    <meta name="Rating" content="general">
    <meta name="author" content="Gabriel Masson">
    <title>Impressão das mensalidades</title>
    <link href="img/favicon.png" rel="shortcut icon" type="image/x-icon">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.6/JsBarcode.all.min.js"
        integrity="sha512-k2wo/BkbloaRU7gc/RkCekHr4IOVe10kYxJ/Q8dRPl7u3YshAQmg3WfZtIcseEk+nGBdK03fHBeLgXTxRmWCLQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
            height: 190px;
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

</head>

<body>
    <div class="bto">
        Ao Imprimir o carnê certifique-se se a impressão está ajustada à página
        <br>
        <br>
        <button class="btn-impress" onclick="window.print()">Imprimir</button>
        &nbsp;
        &nbsp;
        <a href="<?php echo e('/mensalidades_capa'); ?>"><button class="btn-capa">Imprimir capa</button></a>
        &nbsp;
        &nbsp;
        <button class="btn-voltar" onclick="window.history.back()">Voltar</button>

    </div>

    <!-- PARCELA -->

    <?php $__currentLoopData = $mensalidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $mensalidade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="parcela">
            <div class="grid">
                <div class="col4">
                    <div class="destaca">

                        <!-- Parte a esquerda !-->
                        <table width="100%">

                            <tr>
                                <td colspan="2">
                                    <small>Matrícula</small>
                                    <br><?php echo e($mensalidade->matriculas_id); ?>

                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <small>Parcela</small>
                                    <br><?php echo e($mensalidade->id); ?>

                                </td>
                                <td>
                                    <small>Valor</small>
                                    <br>R$ <?php echo e(number_format($mensalidade->valor_parcela, 2, ',', '.')); ?>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <small>Vencimento</small>
                                    <br><?php echo e(date('d/m/Y', strtotime($mensalidade->vencimento))); ?>

                                </td>

                            <tr>
                                <td colspan="2">
                                    <small>Observações</small>
                                    <br><?php echo e($mensalidade->observacao); ?>


                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="col8">
                    <table width="100%">
                        <tr>
                            <td colspan="5" class="text-center">
                                <br> <?php echo e($empresa->nome); ?> - <?php echo e($empresa->cnpj); ?>

                                <br>Telefone: <?php echo e($empresa->telefone); ?> | Celular: <?php echo e($empresa->celular); ?>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <small>Aluno</small>
                                <br><?php echo e($aluno->nome); ?>

                            </td>

                            <td>
                                <small>Matrícula</small>
                                <br><?php echo e($mensalidade->matriculas_id); ?>

                            </td>

                            <td>
                                <small>Parcela</small>
                                <br><?php echo e($mensalidade->id); ?>

                            </td>

                            <td>
                                <small>Valor</small>
                                <br><span style="font-weight: 700">R$
                                    <?php echo e(number_format($mensalidade->valor_parcela, 2, ',', '.')); ?></span>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="1">
                                <small>Vencimento</small>
                                <br><span
                                    style="font-weight: 700"><?php echo e(date('d/m/Y', strtotime($mensalidade->vencimento))); ?></span>
                            </td>

                            <td>
                                <small>Juros</small>
                                <br>0
                            </td>

                            <td>
                                <small>Multa</small>
                                <br>0
                            </td>

                            <td colspan="2">
                                <small>Pagamento</small>
                                <br>___/___/_____
                            </td>

                        </tr>

                        <tr>
                            <td colspan="5">
                                <small>
                                    <?php echo e(Str::substr($config->mensagem, 0, 75)); ?>

                                </small>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5">
                                <svg class="barcode" data-value="<?php echo e($mensalidade->id); ?>"
                                    style="width: 100px; height: 50px;"></svg>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

        <br><br>

        <?php if($index == 2): ?>
            <div class="quebra-pagina">
            </div>
            <?php
                $index = 0;
            ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var barcodeElements = document.querySelectorAll(".barcode");

            barcodeElements.forEach(function(element) {
                var barcodeValue = element.dataset.value;
                JsBarcode(element, barcodeValue, {
                    format: "CODE128", // Escolha o formato de código de barras desejado
                    displayValue: false,
                    width: 1,
                    height: 30,
                });
            });
        });
    </script>

</body>

</html>
<?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/mensalidade/mensalidadesImpressao.blade.php ENDPATH**/ ?>