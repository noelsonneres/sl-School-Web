<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Matrícula do Aluno</title>
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
            <h1>Relatório Matrícula do Aluno</h1>
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
                <td>Cód. Aluno: <?php echo e($matricula->alunos->id); ?></td>
                <td>Matrícula: <?php echo e($matricula->id); ?></td>
                <td colspan="2">Nome: <?php echo e($matricula->alunos->nome); ?></td>
            </tr>

            <tr>
                <td colspan="4">Responsavel: <?php echo e($matricula->responsaveis->nome); ?></td>
            </tr>

            <tr>
                <td colspan="4">Curso: <?php echo e($matricula->cursos->curso); ?></td>
            </tr>

            <tr>
                <td>Qtde. Parcelas: <?php echo e($matricula->qtde_parcela); ?></td>
                <td>Valor a vista: R$ <?php echo e(number_format($matricula->valor_a_vista, 2, ',', '.')); ?></td>
                <td>Valor com desconto: R$ <?php echo e(number_format($matricula->valor_com_desconto, 2, ',', '.')); ?></td>
                <td>Valor parcelado: R$ <?php echo e(number_format($matricula->valor_parcelado, 2, ',', '.')); ?></td>
            </tr>

            <tr>
                <td>Valor por parcela: R$ <?php echo e(number_format($matricula->valor_por_parcela, 2, ',', '.')); ?></td>
                <td>Vencimento: <?php echo e(date('d/m/Y', strtotime($matricula->vencimento))); ?></td>
                <td>Valor da matrícula: R$ <?php echo e(number_format($matricula->valor_matricula, 2, ',', '.')); ?></td>
                <td>Vencimento: <?php echo e(date('d/m/Y', strtotime($matricula->vencimento_matricula))); ?></td>
            </tr>

            <tr>
                <td>Data de início: <?php echo e(date('d/m/Y', strtotime($matricula->data_inicio))); ?></td>
                <td>Previsão de término: <?php echo e(date('d/m/Y', strtotime($matricula->data_termino))); ?></td>
                <td>Qtde. Dias: <?php echo e($matricula->qtde_dias); ?></td>
                <td>Horas por semana: <?php echo e($matricula->horas_semana); ?></td>
            </tr>

            <tr>
                <td colspan="4">Consultor: <?php echo e($matricula->consultores->nome?? ""); ?></td>
            </tr>

            <tr>
                <td>Status da matrícula: <?php echo e($matricula->status); ?></td>
                <td colspan="3">Observacão: <?php echo e($matricula->obs); ?></td>
            </tr>

        </table>

    </div>

    <footer class="mb-5">
        
    </footer>

    <!-- Adicione os scripts do Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/relatorios/matricula/relMatriculaImpressao.blade.php ENDPATH**/ ?>