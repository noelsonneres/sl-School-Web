<?php $__env->startSection('title', 'Disciplinas do professor'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Disciplinas do professor</h3>
    </div>

    <hr>
        <h5>Professor(a): <?php echo e($professor->nome); ?></h5>


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

            <a href="<?php echo e('/adicionar/'.$professor->id); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Incluir disciplina</a>
            <button onclick="(print())" class="btn $teal-300">Imprimir</button>

        </div>

        <div class="col-8 text-end">
            <a href="<?php echo e(route('professores.index')); ?>" class="btn btn-danger">Voltar</a>
        </div>

    </div>

    <hr>

    <div class="card pt-2 mt-4">


        <table class="table p-1">
            <thead>
                <tr>
                    <th scope="col">Cód. Disciplina</th>
                    <th scope="col">Disciplina</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $discProf; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($disc->disciplinas_id); ?> </td>
                    <td><?php echo e($disc->disciplinas->disciplina); ?> </td>

                    <td>

                        <div>
                            <div class="row">

                                <div class="col-2">

                                    <form method="POST" class="delete-form" action="<?php echo e(route('professor_disciplina.destroy', $disc->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" title="Excluir a disciplina do professor" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">
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

                        </div>

                    </td>
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Exibir a barra de paginação -->
        <div class="row">
            <div>
                <?php echo e($discProf->links('pagination::pagination')); ?>

            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/disciplinasProfessores/disciplinasProfessoresShow.blade.php ENDPATH**/ ?>