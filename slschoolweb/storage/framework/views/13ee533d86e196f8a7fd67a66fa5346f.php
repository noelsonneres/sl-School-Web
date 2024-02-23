
<?php $__env->startSection('title', 'Matrículas'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Matrículas</h4>
        </div>


        <?php if(isset($msg)): ?>
            <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                        justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5><?php echo e($msg); ?> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        <?php endif; ?>

        <hr>

        <div class="row">

            <div class="col-4">

                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

            <div class="col-8">

                <form action="/matricula_localizar" method="get">
                    <?php echo csrf_field(); ?>

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="alunos_id">Código do aluno</option>
                                <option value="id">Matrícula</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="find" id="find"
                                placeholder="Digite o que deseja buscar">
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success btn-sm">Pesquisar</button>
                        </div>

                    </div>

                </form>

            </div>

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <div class="table-responsive">
                <table class="table p-1">
                    <thead>
                        <tr>
                            <th scope="col">Matrícula</th>
                            <th scope="col">Aluno</th>
                            <th scope="col">Cód. Aluno</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Data início</th>
                            <th scope="col">Previsão de término</th>
                            <th scope="col">Ativa</th>
                            <th scope="col">Operações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $matriculas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matricula): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($matricula->id); ?> </td>
                                <td><?php echo e($matricula->alunos->nome); ?> </td>
                                <td><?php echo e($matricula->alunos->id); ?> </td>
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

                                        <div class="col-2">
                                            <a href="<?php echo e(route('alunos.edit', $matricula->alunos_id)); ?>"
                                                title="Visualizar informações do aluno" class="btn btn-success btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="<?php echo e('/responsavel_adicionar/' . $matricula->alunos->id . '/' . $matricula->alunos->nome); ?>"
                                                title="Visualizar informações do responsável" class="btn btn-info btn-sm">
                                                <i class="bi bi-person-rolodex"></i>
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

            </div>

            <div class="container-fluid pl-5 d-flex justify-content-center">
                <?php echo e($matriculas->links('pagination::pagination')); ?>

            </div>

        </div>



    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/matricula/matriculaSelect.blade.php ENDPATH**/ ?>