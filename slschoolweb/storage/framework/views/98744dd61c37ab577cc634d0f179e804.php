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

        <div class="mb-2 mt-2 float-end pe-5">
            <img src="/img/aluno/<?php echo e($aluno->foto); ?>" alt="" class="foto rounded-circle">
        </div>

        

        <table class="table table-bordered table-responsive">

            <tr>
                <td colspan="1">Código: <?php echo e($aluno->id); ?></td>
                <td colspan="2">Nome: <?php echo e($aluno->nome); ?> </td>
                <td colspan="1">Apelido: <?php echo e($aluno->apelido); ?></td>
            </tr>

            <tr>
                <td colspan="1">Dt nascimento: <?php echo e(date('d/m/Y', strtotime($aluno->data_nascimento))); ?></td>
                <td>Dt cadastro: <?php echo e(date('d/m/Y', strtotime($aluno->data_cadastro))); ?></td>
                <td>CPF: <?php echo e($aluno->cpf); ?></td>
                <td>RG: <?php echo e($aluno->rg); ?></td>
            </tr>

            <tr>
                <td colspan="2">Fobias: <?php echo e($aluno->fobias); ?></td>
                <td colspan="2">Alergias: <?php echo e($aluno->alergias); ?></td>
            </tr>

            <tr>
                <td colspan="2">Deficiencias: <?php echo e($aluno->deficiencias); ?></td>
                <td colspan="2">outros_aspectos: <?php echo e($aluno->deficiencias); ?></td>
            </tr>

            <tr>
                <td colspan="2">Endereço: <?php echo e($aluno->endereco); ?></td>
                <td colspan="2">Bairro: <?php echo e($aluno->bairro); ?></td>
            </tr>

            <tr>
                <td colspan="2">Complemento: <?php echo e($aluno->complemento); ?></td>
                <td>Número: <?php echo e($aluno->numero); ?></td>
                <td>CEP: <?php echo e($aluno->cep); ?></td>
            </tr>

            <tr>
                <td colspan="3">Cidade: <?php echo e($aluno->cidade); ?></td>
                <td>Estado: <?php echo e($aluno->estado); ?></td>
            </tr>

            <tr>
                <td>Telefone: <?php echo e($aluno->telefone); ?></td>
                <td>Celular: <?php echo e($aluno->celular); ?></td>
                <td colspan="2">E-Mail: <?php echo e($aluno->email); ?></td>
            </tr>

            <tr>
                <td>Estado civil: <?php echo e($aluno->estado_civil); ?></td>
                <td colspan="2">Profissão: <?php echo e($aluno->profissao); ?></td>
                <td>Nacionalidade: <?php echo e($aluno->nacionalidade); ?></td>
            </tr>

            <tr>
                <td colspan="2">Nome da mãe: <?php echo e($aluno->nome_mae); ?></td>
                <td>RG mãe: <?php echo e($aluno->rg_mae); ?></td>
                <td>CPF mãe: <?php echo e($aluno->cpf_mae); ?></td>
            </tr>

            <tr>
                <td colspan="2">Nome do pai: <?php echo e($aluno->nome_pai); ?></td>
                <td>RG mãe: <?php echo e($aluno->rg_pai); ?></td>
                <td>CPF mãe: <?php echo e($aluno->cpf_pai); ?></td>
            </tr>  
            
            <tr>
                <td>Ativo: <?php echo e($aluno->ativo); ?></td>
                <td colspan="3">Observação: <?php echo e($aluno->observacao); ?></td>
            </tr>

        </table>

      </div>

        <footer class="mb-5">
            
        </footer>

        <!-- Adicione os scripts do Bootstrap 5 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/relatorios/aluno/relAlunosImpressao.blade.php ENDPATH**/ ?>