<?php $__env->startSection('title', 'Disciplinas do aluno'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Disciplinas do aluno</h3>
        </div>

        <?php if(isset($msg)): ?>
            <div class="alert alert-warning alert-dismissible fade show msg d-flex
							justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5><?php echo e($msg); ?> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        <?php endif; ?>

        <div class="row">

            <div class="col-8">

                <a href="<?php echo e('/matricula_disciplina_adicionar/' . $matricula->id); ?>" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-circle-fill"></i>
                    Adicionar Disciplina</a>

                <a href="<?php echo e(route('matricula.show', $matricula)); ?>"class="btn btn-info mb-2">
                    <i class="bi bi-plus-circle-fill"></i>
                    Matrícula </a>

                <button onclick="(print())" class="btn $teal-300 mb-2">Imprimir</button>

            </div>

        </div>

        <hr>
        <div class="m-4">
            <h4>Aluno(a): <?php echo e($matricula->alunos->nome); ?></h4>
            <h4>Matrícula: <?php echo e($matricula->id); ?></h4>
        </div>
        <hr>

        <div class="card pt-2 mt-4">


            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Disciplina</th>
                        <th scope="col">Início</th>
                        <th scope="col">Término</th>
                        <th scope="col">Concluido</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $disciplinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disciplina): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($disciplina->id); ?> </td>
                            <td><?php echo e(Str::substr($disciplina->disciplinas->disciplina, 0, 30)); ?> </td>

                            <td>
                                <?php if($disciplina->inicio): ?>
                                    <?php echo e(date('d/m/Y', strtotime($disciplina->inicio))); ?>

                            </td>
                    <?php endif; ?>

                    <td>
                        <?php if($disciplina->termino): ?>
                            <?php echo e(date('d/m/Y', strtotime($disciplina->termino))); ?>

                    </td>
                    <?php endif; ?>

                    <?php if($disciplina->concluido == 'Concluido'): ?>
                        <td style="color: #235e04; font-weight: bold"><?php echo e($disciplina->concluido); ?> </td>
                    <?php else: ?>
                        <td><?php echo e($disciplina->concluido); ?> </td>
                    <?php endif; ?>

                    <td>

                        <div>
                            <div class="row">

                                <div class="col-2">
                                    <a href="<?php echo e(route('matricula_disciplina.edit', $disciplina->id)); ?>"
                                        title="Atualizar informações sobre o andamento da disciplina"
                                        class="btn btn-success btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>

                                <div class="col-2">

                                    <form method="POST" class="delete-form"
                                        action="<?php echo e(route('matricula_disciplina.destroy', $disciplina->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="btn btn-danger btn-sm" title="Remover disciplina"
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/disciplina/disciplinasShow.blade.php ENDPATH**/ ?>