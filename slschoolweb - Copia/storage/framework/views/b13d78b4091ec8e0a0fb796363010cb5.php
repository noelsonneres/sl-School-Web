<?php $__env->startSection('title', 'Turmas do aluno'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Turmas do aluno</h3>
    </div>

    <?php if(isset($msg)): ?>
    <div class="alert alert-warning alert-dismissible fade show msg d-flex
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
        <h5><?php echo e($msg); ?> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
    <?php endif; ?>

    <hr>

        <h4>Aluno(a): <?php echo e($aluno->nome); ?></h4>
        <h4>Matrícula: <?php echo e($matricula); ?></h4>
        <h5>Responsável: <?php echo e($responsavel->nome); ?></h5>

    <hr>

    <div class="row">

        <div class="col-4">
            <a href="<?php echo e(('/turmas_matriculas_inserir/'.$matricula)); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Adicionar turma </a>

                <a href="<?php echo e(route('matricula.show', $matricula)); ?>"class="btn btn-info">
                    <i class="bi bi-plus-circle-fill"></i>
                    Matrícula </a>                

            <button onclick="(print())" class="btn $teal-300">Imprimir</button>
        </div>

    </div>

    <hr>

    <div class="card pt-2 mt-4">


        <table class="table p-1">
            <thead>
                <tr>
                    <th scope="col">Turma</th>
                    <th scope="col">Dias</th>
                    <th scope="col">Horários</th>
                    <th scope="col">Sala</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>

                <?php $__currentLoopData = $turmas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $turma): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($turma->turmas->turma); ?> </td>
                    <td><?php echo e($turma->turmas->dias->dia1); ?> - <?php echo e($turma->turmas->dias->dia2); ?> </td>
                    <td><?php echo e($turma->turmas->horarios->entrada); ?> - <?php echo e($turma->turmas->horarios->saida); ?> </td>
                    <td><?php echo e($turma->turmas->sala->sala); ?> </td>

                    <td>

                            <div class="row">
                                <div class="col-3">

                                    <form method="POST" class="delete-form"
                                        action="<?php echo e(('/turmas_matriculas_remover/'.$matricula.'/'.$turma->id)); ?>">
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
                <?php echo e($turmas->links('pagination::pagination')); ?>

            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/turma/matriculaTurmaShow.blade.php ENDPATH**/ ?>