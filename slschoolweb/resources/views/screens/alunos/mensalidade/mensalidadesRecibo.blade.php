<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    <title>Recibo de pagamento</title>
    <style>
        .row-cols-3 > * {
            flex: 0 0 33.33%;
            max-width: 35.33%;
        }
    </style>
</head>

<body>

    <div class="container pt-5">

        <div class="row p-3">

            <div class="col-md-2">
                <button class="btn btn-primary" onclick="cont();">Impressora laser</button>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary">Impressora térmica</button>
            </div>

        </div>

        <div class="card ps-2 pe-2" id="print">
            <h1>Recibo</h1>

            <form action="">

                <div class="row mb-2 border-top border-bottom pb-2">

                    <div class="col-md-6">
                        <label for="aluno" class="form-label">Alunos</label>
                        <input type="text" class="form-control" name="aluno" id="aluno" readonly
                            value="Ana maria de souza santos">
                    </div>

                    <div class="col-md-3">
                        <label for="codAluno" class="form-label">Código do aluno</label>
                        <input type="text" class="form-control" name="codAluno" id="codAluno" readonly
                            value="12">
                    </div>

                    <div class="col-md-3">
                        <label for="matricula" class="form-label">Matrícula</label>
                        <input type="text" class="form-control" name="matricula" id="matricula" readonly
                            value="15">
                    </div>

                </div>

                <div class="row row-cols-3 mb-2">

                    <div class="col-md-4">
                        <label for="aluno" class="form-label">Alunos</label>
                        <input type="text" class="form-control" name="aluno" id="aluno" readonly
                            value="Ana maria de souza santos">
                    </div>

                    <div class="col-md-4">
                        <label for="codAluno" class="form-label">Código do aluno</label>
                        <input type="text" class="form-control" name="codAluno" id="codAluno" readonly
                            value="12">
                    </div>

                    <div class="col-md-4">
                        <label for="matricula" class="form-label">Matrícula</label>
                        <input type="text" class="form-control" name="matricula" id="matricula" readonly
                            value="15">
                    </div>

                </div>    
                
                <div class="row">
                    <div class="border">
                        <div class="row">
                            <div class="col-md-5">
                                <p>Maria Rita de Souza</p>
                            </div>
                            <div class="col-md-3">
                                <p>Valor matrícula: R$ 50.00</p>
                            </div>

                            <div class="col-md-3">
                                <p>Valor matrícula: R$ 50.00</p>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script> --}}

    <script>
        function cont() {
            var conteudo = document.getElementById('print').outerHTML;
            var tela_impressao = window.open('', '_blank');
            tela_impressao.document.write('<html><head><title>Recibo de Pagamento</title>');
            tela_impressao.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />');
            tela_impressao.document.write('<style>.row-cols-3 > * {flex: 0 0 33.33%;max-width: 33.33%;}</style>');
            tela_impressao.document.write('</head><body>');
            tela_impressao.document.write(conteudo);
            tela_impressao.document.write('</body></html>');
            tela_impressao.document.close();
            tela_impressao.print();
        }
    </script>

</body>

</html>
