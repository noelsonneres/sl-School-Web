<?php $__env->startSection('title', 'Novo Material'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Incluir novo material</h3>
    </div>

    <hr>

    <div class="card p-5">

        <form action="<?php echo e(route('materiais.store')); ?>" method="post" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label for="material" class="form-label lblCaption">Material</label>
                <input type="text" class="form-control" name="material" id="material"
                     placeholder="Digite um curso para o professor" maxlength="100" autofocus required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label lblCaption">Descrição</label>
                <input type="text" class="form-control" name="descricao" id="descricao" maxlength="100">
            </div>

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label for="valorUn" class="form-label lblCaption">Valor unitário</label>
                    <input type="number" step="0.01" min="0.01" class="form-control" name="valorUn" id="valorUn">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="quantidade" class="form-label lblCaption">Quantidade</label>
                    <input type="number" class="form-control" name="quantidade" id="quantidade">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="ativo" class="form-label lblCaption">Ativo</label>
                    <select class="form-control" name="ativo" id="ativo">
                        <option value="">Selecione uma opção</option>
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                    </select>
                </div>

            </div>


            <div class="mb-4">
                <label for="obs" class="form-label lblCaption">Observação</label>
                <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
            </div>


            <div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-floppy2"></i>
                    Salvar</button>

                <a href="/materiais" class="btn btn-danger">
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/materiasEscolares/materiasEscolaresCreate.blade.php ENDPATH**/ ?>