<?php $__env->startSection('title', 'Incluir material'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Incluir material</h3>
        </div>

        <div class="row">

            <div class="col-4">
    
                <a href="<?php echo e(route('matricula.show', $matricula->id)); ?>"class="btn btn-info">
                    <i class="bi bi-plus-circle-fill"></i>
                    Matrícula </a>           
    
            </div>  
            
        </div>   


        <hr>

        <h4 class="m-2">Aluno(a): <?php echo e($aluno->nome); ?></h4>
        <h5 class="m-2">Matricula: <?php echo e($matricula->id); ?> </h5>

        <hr>

        <div class="card p-5">

            <form action="<?php echo e(route('matricula_materiais.store')); ?>" method="post" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>

                <input type="hidden" name="matricula" id="matricula" value="<?php echo e($matricula->id); ?>">
                <input type="hidden" name="aluno" id="aluno" value="<?php echo e($aluno->id); ?>">

                <div class="mb-4">
                    <label for="material" class="form-label lblCaption">Material</label>
                    <select class="form-control" name="material" id="material" required>
                        <option value="">Selecione um material</option>

                        <?php $__currentLoopData = $listaMaterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($material->id); ?>" data-valor-un=<?php echo e($material->valor_un); ?>

                                data-qtde=<?php echo e($material->qtde); ?>><?php echo e($material->material); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                </div>

                <div class="row">

                    <div class="col-md-3 mb-4">
                        <label for="valorUN" class="form-label lblCaption">Valor por unidade</label>
                        <input type="number" step="0.01" min="0.01"  class="form-control"
                             name="valorUN" id="valorUN" required>
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="qtde" class="form-label lblCaption">Quantidade</label>
                        <input type="number" step="1" min="0"  class="form-control" name="qtde"
                             id="qtde" onchange="calcular()" required>
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="total" class="form-label lblCaption">Total</label>
                        <input type="number" step="0.01" min="0.01"  class="form-control"
                             name="total" id="total" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="vencimento" class="form-label lblCaption">Vencimento</label>
                        <input type="date" class="form-control" name="vencimento" id="vencimento" required>
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

                    <a href="/professores" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

    


    <script>
        function calcular() {
            var valorUNInput = document.getElementById("valorUN");
            var qtdeInput = document.getElementById("qtde");

            // Obter a opção selecionada no elemento select
            var materialSelect = document.getElementById("material");
            var qtdeDisponivel = $('option:selected', materialSelect).data('qtde');

            // console.log(qtdeDisponivel);

            var valorUN = parseFloat(valorUNInput.value);
            var qtde = parseFloat(qtdeInput.value);

            if(qtdeDisponivel < qtde){
                window.alert('A quantidade informada é maior do a disponível no estoque!');
                qtde = 0;
                valorUN = 0;
                document.getElementById("qtde").value = '0'; 
            }

            if (!isNaN(valorUN) && !isNaN(qtde)) {
                var resultadoDivisao = valorUN * qtde;
                document.getElementById("total").value = resultadoDivisao.toFixed(2);
            }
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#material').change(function() {
                var valor_un = $('option:selected', this).data('valor-un');
                var qtde = $('option:selected', this).data('qtde');

                if (qtde <= 0) {
                    window.alert('Não há unidade suficientes para a inclusão');
                    $('#valorUN').val(0);
                    $('#qtde').val(0);
                    $('#total').val(0);
                } else {
                    $('#valorUN').val(valor_un);
                    $('#qtde').val(1);
                    $('#total').val(valor_un);
                }

            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/materiais/matriculaMateriaisCreate.blade.php ENDPATH**/ ?>