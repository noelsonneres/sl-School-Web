<?php $__env->startSection('title', 'Lista dos materiais'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Lista dos materiais escolares</h3>
    </div>
    
    <?php if(isset($msg)): ?>
    <div class="alert alert-warning alert-dismissible fade show msg d-flex 
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
        <h5><?php echo e($msg); ?> </h5>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
    <?php endif; ?>

    <hr>

    <div class="row">

        <div class="col-4">

            <a href="<?php echo e('/matricula_materiais_adicionar/'.$matricula->id); ?>"class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Incuir material </a>           

                <a href="<?php echo e('/matricula_material_parcelas/'.$matricula->id); ?>"class="btn btn-success" 
                title="Gerar parcelas" >
                    <i class="bi bi-currency-dollar"></i>
                    Gerar parcelas </a>                

            <button onclick="(print())" class="btn $teal-300">Imprimir</button>

        </div>     

    </div>

    <hr>

    <h4 class="m-3">Aluno(a): <?php echo e($aluno->nome); ?></h4>
    <h5 class="m-3">Matricula: <?php echo e($matricula->id); ?> </h5>

    <hr>

    <div class="card pt-2 mt-4">


        <table class="table p-1">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Material</th>
                    <th scope="col">Valor UN</th>
                    <th scope="col">Qtde</th>
                    <th scope="col">Valor total</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>

                <?php $__currentLoopData = $materiais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($material->id); ?> </td>
                    <td><?php echo e(Str::substr($material->material->material, 0, 30)); ?> </td>
                    <td>R$ <?php echo e(number_format($material->valor_un, 2, ',', '.')); ?> </td>
                    <td><?php echo e($material->qtde); ?> </td>
                    <td>R$ <?php echo e(number_format($material->valor_total, 2, ',', '.')); ?> </td>

                    <td>

                            <div class="row">                          

                                <div class="col-2">
                                    <a href="<?php echo e(('/matricula_material_parcela/'.$material->matriculas_id.'/'.$material->id)); ?>" 
                                           title="Gerar parcela apenas deste" class="btn btn-success btn-sm">
                                           <i class="bi bi-card-list"></i>
                                    </a>
                                </div>

                                <div class="col-3">

                                    <form method="POST" class="delete-form"
                                        action="<?php echo e(route('matricula.destroy', $matricula->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete(this)">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>

                                    <script>
                                        function confirmDelete(button) {
                                            if (confirm('Tem certeza de que deseja excluir este item?')) {
                                                var form = button.closest('form');
                                                form.submit();
                                            }
                                        }
                                    </script>


                                </div>

                            </div>

                    </td>
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
               
            </tbody>
        </table>

        <div class="row">
            <div>
                <?php echo e($materiais->links('pagination::pagination')); ?>

            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/materiais/matriculaMateriais.blade.php ENDPATH**/ ?>