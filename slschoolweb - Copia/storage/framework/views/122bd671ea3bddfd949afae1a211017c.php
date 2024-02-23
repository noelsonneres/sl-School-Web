<?php $__env->startSection('title', 'Novo curso'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Incluir um novo curso</h3>
    </div>

    <hr>

    <div class="card p-5">

        <form action="<?php echo e(route('cursos.store')); ?>" method="post" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label for="curso" class="form-label lblCaption">Curso</label>
                <input type="text" class="form-control" name="curso" id="curso"
                     placeholder="Digite um curso para o professor" maxlength="100" autofocus required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label lblCaption">Descrição</label>
                <input type="text" class="form-control" name="descricao" id="descricao" maxlength="100">
            </div>

            <div class="row">

                <div class="col-md-2 mb-3">
                    <label for="valorAvista" class="form-label lblCaption">Valor a Vista</label>
                    <input type="number" step="0.01" min="0.01" class="form-control" name="valorAvista" id="valorAvista">
                </div>

                <div class="col-md-2 mb-3">
                    <label for="valorComDesconto" class="form-label lblCaption">Valor com desconto</label>
                    <input type="number" step="0.01" min="0.01" class="form-control" name="valorComDesconto" id="valorComDesconto">
                </div>

                <div class="col-md-2 mb-3">
                    <label for="qtdeParcelas" class="form-label lblCaption">Qtde Parcelas</label>
                    <input type="number" onchange="calcular()" onblur="calcular()" 
                        class="form-control" name="qtdeParcelas" id="qtdeParcelas">
                </div>

                <div class="col-md-2 mb-3">
                    <label for="valorParcelado" class="form-label lblCaption">Valor parcelado</label>
                    <input type="number" step="0.01" min="0.01" onchange="calcular()" onblur="calcular()" 
                        class="form-control" id="valorParcelado" name="valorParcelado">
                </div>

                <div class="col-md-2 mb-3">
                    <label for="valorPorParcela" class="form-label lblCaption">Valor por parcela</label>
                    <input type="number" step="0.01" min="0.01" oninput="calcular()" class="form-control"
                         id="valorPorParcela" name="valorPorParcela">
                </div>

            </div>

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label for="duracaoMeses" class="form-label lblCaption">Duração em meses</label>
                    <input type="number" class="form-control" name="duracaoMeses" id="duracaoMeses">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="cargaHoraria" class="form-label lblCaption">Carga horária</label>
                    <input type="number" class="form-control" name="cargaHoraria" id="cargaHoraria">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="ativo" class="form-label lblCaption">Ativo?</label>
                    <select class="form-control" name="opt" id="opt">
                        <option value="">Selecione uma opção</option>
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                    </select>
                </div>                

            </div>

            <div class="mb-4">
                <label for="obs" class="form-label lblCaption">Observação</label>
                <input type="text" class="form-control" name="obs" id="obs">
            </div>


            <div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-floppy2"></i>
                    Salvar</button>

                <a href="/professores" class="btn btn-danger">
                    <i class="bi bi-x-circle-fill"></i>
                    Cancelar</a>
            </div>

        </form>

    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function calcular() {
        var qtdeParcelaInput = document.getElementById("qtdeParcelas");
        var ValorParceladoInput = document.getElementById("valorParcelado");
        
        var qtdeParcela = parseFloat(qtdeParcelaInput.value);
        var ValorParcelado = parseFloat(ValorParceladoInput.value);

        if (!isNaN(qtdeParcela) && !isNaN(ValorParcelado)) {
            var resultadoDivisao = ValorParcelado / qtdeParcela;
            document.getElementById("valorPorParcela").value = resultadoDivisao.toFixed(2);
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/cursos/cursosCreate.blade.php ENDPATH**/ ?>