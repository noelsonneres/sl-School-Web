<?php $__env->startSection('title', 'Lista de disciplinas do curso'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Lista das Disciplinas</h3>
    </div>
    <hr>
        <h4>Curso: <?php echo e($curso); ?></h4>
        <h5>Cód. Curso: <?php echo e($cursoId); ?></h5>


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

            <a href="<?php echo e('/ad_curso_disciplinas/'.$cursoId); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Nova disciplina</a>
            <button onclick="(print())" class="btn $teal-300">Imprimir</button>

        </div>

    </div>

    <hr>

    <div class="card pt-2 mt-4">


        <table class="table p-1">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Disciplina</th>
                    <th scope="col">Duração</th>
                    <th scope="col">Carga horária</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $disciplinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disciplina): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($disciplina->disciplinas->id); ?> </td>
                    <td><?php echo e($disciplina->disciplinas->disciplina); ?> </td>
                    <td><?php echo e($disciplina->disciplinas->duracao_meses); ?> </td>
                    <td><?php echo e($disciplina->disciplinas->carga_horaria); ?> </td>

                    <td>

                        <div>
                            <div class="row">

                                <div class="col-2">

                                    <form method="POST" class="delete-form" action="<?php echo e('/deletar_curso_disciplina/'. $disciplina->id); ?>">
                                        <?php echo csrf_field(); ?>
                                        
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">
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
                <?php echo e($disciplinas->links('pagination::pagination')); ?>

            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/cursosDisciplinas/cursosDisciplinasShow.blade.php ENDPATH**/ ?>