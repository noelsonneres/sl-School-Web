<?php $__env->startSection('title', 'Matrículas do aluno'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Matrículas do aluno</h3>
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
        <h5>Cód. Aluno(a): <?php echo e($aluno->id); ?> </h5>
        <h5>Responsável: <?php echo e(isset($responsavel->nome)); ?></h5>

    <hr>

    <div class="row">

        <div class="col-4">

            <a href="<?php echo e('/matricula_adicionar/'.$aluno->id); ?>"class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Nova Matrícula </a>
            <button onclick="(print())" class="btn $teal-300">Imprimir</button>

        </div>     

    </div>

    <hr>

    <div class="card pt-2 mt-4">


        <table class="table p-1">
            <thead>
                <tr>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Data início</th>
                    <th scope="col">Data término</th>
                    <th scope="col">Ativa</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>

                <?php $__currentLoopData = $matriculas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matricula): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($matricula->id); ?> </td>
                    <td><?php echo e(Str::substr($matricula->cursos->curso, 0, 30)); ?> </td>
                    <td><?php echo e(date('d/m/Y', strtotime($matricula->data_inicio))); ?> </td>
                    <td><?php echo e(date('d/m/Y', strtotime($matricula->data_termino))); ?> </td>
                    <td><?php echo e($matricula->status); ?> </td>

                    <td>

                            <div class="row">                          

                                <div class="col-2">
                                    <a href="<?php echo e(route('matricula.show', $matricula->id)); ?>" 
                                           title="Visualizar informações do matricula" class="btn btn-primary btn-sm">
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
                <?php echo e($matriculas->links('pagination::pagination')); ?>

            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/matricula/matriculaShow.blade.php ENDPATH**/ ?>