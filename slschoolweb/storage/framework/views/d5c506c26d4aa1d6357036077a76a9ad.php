<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações da Mensalidade</title>
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
            <h1>Informações da Mensalidade</h1>
        </header>


        

        <table class="table border">
            <tr>
                <td>
                    <div class="col-md-2">
                        <img src="/img/logo/<?php echo e($empresa->foto); ?>" alt="" class="logo">
                    </div>
                </td>
                <td>
                    <div class="col-md-10 text-end">
                        <h4><?php echo e($empresa->nome); ?></h4>
                        <h6><?php echo e($empresa->cnpj); ?></h6>
                        <h6>Tel: <?php echo e($empresa->telefone); ?>- Cel/WhatsApp: <?php echo e($empresa->celular); ?></h6>
                    </div>
                </td>
            </tr>

        </table>

        <hr>

        

        <table class="table table-bordered table-responsive">

            <tr>
                <td>Mensalidade: <?php echo e($mensalidade->id); ?></td>
                <td>Matricula: <?php echo e($mensalidade->matriculas->id); ?></td>
                <td colspan="2">Nome completo: <?php echo e($mensalidade->alunos->nome); ?></td>
            </tr>

            <?php if(isset($mensalidade->responsaveis->nome)): ?>
                <tr>
                    <td colspan="4">Responsável: <?php echo e($mensalidade->responsaveis->nome); ?></td>
                </tr>
                <?php endif; ?>

                <tr>
                    <td>Valor mensalidade: R$ <?php echo e(number_format($mensalidade->valor_parcela, '2', ',', '.')); ?></td>
                    <td>Vencimento: <?php echo e(date('d/m/Y', strtotime($mensalidade->vencimento))); ?></td>
                    <td>Juros: R$ <?php echo e(number_format($mensalidade->juros)); ?></td>
                    <td>Multa: R$ <?php echo e(number_format($mensalidade->multa)); ?></td>
                </tr>

                <tr>
                    <td>Desconto: R$ <?php echo e(number_format($mensalidade->desconto, '2', ',', '.')); ?></td>
                    <td>Acréscimo: R$ <?php echo e(number_format($mensalidade->acrescimo, '2', ',', '.')); ?></td>
                    <td>Total a pagar: R$ <?php echo e(number_format($mensalidade->valor_pago, '2', ',', '.')); ?></td>

                    <?php if($mensalidade->data_pagamento != null): ?>
                        <td>Data de pagamento: <?php echo e(date('d/m/Y', strtotime($mensalidade->data_pagamento))); ?></td>
                    <?php else: ?>
                        <td>Data de pagamento: </td>
                    <?php endif; ?>
                </tr>

                <tr>
                    <td>Pago: <?php echo e($mensalidade->pago); ?></td>
                    <td colspan="3">Forma de pagamento: <?php echo e($mensalidade->forma_pagamento); ?></td>
                </tr>

                <tr>
                    <td colspan="4">Responsavel pelo pagamento: <?php echo e($mensalidade->responsavel_pagamento); ?></td>
                </tr>

                <tr>
                    <td colspan="4">Observação: <?php echo e($mensalidade->observacao); ?></td>
                </tr>

            </table>

        </div>

        <footer class="mb-5">

        </footer>

        <!-- Adicione os scripts do Bootstrap 5 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/relatorios/mensalidade/relMensalidadesImpressao.blade.php ENDPATH**/ ?>