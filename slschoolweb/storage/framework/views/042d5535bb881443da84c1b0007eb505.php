<?php $__env->startSection('title', 'Confirmar as informações da parcela'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Confirme as informações antes de gerar as parcelas</h3>
        </div>

        <div class="row">

            <div class="col-4">
    
                <a href="<?php echo e(route('matricula.show', $dadosAluno['matriculaID'])); ?>"class="btn btn-info">
                    <i class="bi bi-plus-circle-fill"></i>
                    Matrícula </a>           
    
            </div>  
            
        </div>

        <hr>

        <h4 class="m-2">Aluno(a): <?php echo e($dadosAluno['alunoNome']); ?></h4>
        <h5 class="m-2">Matricula: <?php echo e($dadosAluno['matriculaID']); ?> </h5>

        <hr>

        <div class="card p-5">

            <form action="<?php echo e(('/matricula_material_gerar_parcela')); ?>" method="post" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>

                <input type="hidden" name="matricula" id="matricula" value="<?php echo e($dadosAluno['matriculaID']); ?>">
                <input type="hidden" name="aluno" id="aluno" value="<?php echo e($dadosAluno['alunoID']); ?>">
                <input type="hidden" name="responsavel" id="responsavel" value="<?php echo e($dadosAluno['responsavelID']); ?>">

                <div class="row">
                    
                    <div class="col-md-3 mb-3">
                        <label for="valor" class="form-label lblCation">Valor (R$)</label>
                        <input type="number" step="0.01" min="0.01"  class="form-control" 
                         name="valor" id="valor" required value="<?php echo e($totalMateriais); ?>" readonly>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="qtde" class="form-label lblCaption">Qtde. Parcelas</label>
                        <input type="number" step="1" min="1"  class="form-control" name="qtde" id="qtde" 
                            required value="1" onchange="calcular()" onblur="calcular()">
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="valorParcela" class="form-label lblCaption">Valor parcela (R$)</label>
                        <input type="number" step="0.01" min="0.01"  class="form-control" name="valorParcela" id="valorParcela"
                        value="<?php echo e($totalMateriais); ?>">
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="vencimento" class="form-label lblCaption">Vencimento</label>
                        <input type="date" class="form-control" name="vencimento" id="vencimento" required>
                    </div>                    

                </div>  
                
                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="50"
                    value="Parcela referente a inclusão do material escolar">
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

  

  <script>
    function calcular() {
        var valorInput = document.getElementById("valor");
        var qtdeInput = document.getElementById("qtde");

        var valor = parseFloat(valorInput.value);
        var qtde = parseFloat(qtdeInput.value);

        if (!isNaN(valor) && !isNaN(qtde)) {
            var resultadoDivisao = valor / qtde;
            document.getElementById("valorParcela").value = resultadoDivisao.toFixed(2);
        }
    }
</script>    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/materiais/matriculaMaterialParcelas.blade.php ENDPATH**/ ?>