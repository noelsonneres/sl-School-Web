<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Matrículas Canceladas</title>
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
            <h1>Relatório Matrículas Canceladas</h1>
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
                <td>Cód. aluno: <?php echo e($cancelado->alunos_id); ?></td>
                <td>Matrícula: <?php echo e($cancelado->matriculas_id); ?></td>
                <td colspan="2">Aluno: <?php echo e($cancelado->alunos->nome); ?></td>
            </tr>

            <tr>
                <td colspan="4">Curso: <?php echo e($cancelado->matriculas->cursos->curso); ?></td>
            </tr>

            <tr>
                <td>Data cancelamento: <?php echo e(date('d/m/Y', strtotime($cancelado->data))); ?></td>
                <td>Horário: <?php echo e($cancelado->hora); ?></td>
                <td>Status: <?php echo e($cancelado->matriculas->status); ?></td>
                <td>Motivo: <?php echo e($cancelado->motivo); ?></td>
            </tr>

            <tr>
                <td colspan="4">Observação: <?php echo e($cancelado->observacao); ?></td>
            </tr>

        </table>

    </div>

    <footer class="mb-5">

    </footer>

    <!-- Adicione os scripts do Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/relatorios/cancelado/relMatriculaCanceladosImpressao.blade.php ENDPATH**/ ?>