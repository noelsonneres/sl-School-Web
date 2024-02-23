<?php $__env->startSection('title', 'Lista de Cursos'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Lista de Cursos</h3>
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

            <a href="<?php echo e(route('cursos.create')); ?>" class="btn btn-primary"
                title="Criar novo curso">
                <i class="bi bi-plus-circle-fill"></i>
                Novo</a>
            <button onclick="(print())" class="btn $teal-300">Imprimir</button>

        </div>

        <div class="col-8">

            <form action="/cursos_pesquisar" method="get">
                <?php echo csrf_field(); ?>

                <div class="row">

                    <div class="col-md-3">
                        <select class="form-control" name="opt" id="opt">
                            <option value="id">Código</option>
                            <option value="curso">Curso</option>
                            <option value="desscricao">Descricao</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <input type="text" class="form-control" name="find" id="find" placeholder="Digite o que deseja buscar">
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


        <table class="table p-1">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Valor a vista</th>
                    <th scope="col">Duração Meses</th>
                    <th scope="col">Carga horária</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($curso->id); ?> </td>
                    <td><?php echo e($curso->curso); ?> </td>
                    <td>R$ <?php echo e(number_format($curso->valor_avista, 2, ',', '.')); ?> </td>
                    <td><?php echo e($curso->duracao_meses); ?> </td>
                    <td><?php echo e($curso->carga_horaria); ?> </td>

                    <td>

                        <div>
                            <div class="row">                          

                                <div class="col-2">
                                    <a href="<?php echo e('/cursos_disciplinas/' . $curso->id . '/' . $curso->curso); ?>"
                                           title="Disciplinas do curso" class="btn btn-info btn-sm">
                                           <i class="bi bi-journal-bookmark"></i>
                                    </a>
                                </div>

                                <div class="col-2">
                                    <a href="<?php echo e(route('cursos.edit', $curso->id)); ?>" 
                                           title="Editar informações do professor" class="btn btn-success btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>

                                <div class="col-2">

                                    <form method="POST" class="delete-form" action="<?php echo e(route('cursos.destroy', $curso->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" title="Excluir professor" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">
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

        <div class="row">
            <div>
                <?php echo e($cursos->links('pagination::pagination')); ?>

            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/cursos/cursosShow.blade.php ENDPATH**/ ?>