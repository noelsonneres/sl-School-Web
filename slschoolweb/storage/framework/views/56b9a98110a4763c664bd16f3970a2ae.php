<?php $__env->startSection('title', 'Níveis de acesso dos usuários'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white ps-3 pt-2">Níveis de acesso dos usuários</h4>
            <p class="text-center text-white ps-3 pt-1 pb-3">Definir ou ajustar os níveis de acesso dos funcionário</p>
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

            <hr>
            <div class="ps-3 pt-2 pb-2">
                <h4>Usuário: <?php echo e($usuario->user_name); ?></h4>
                <h4>Nome: <?php echo e($usuario->name); ?></h4>
            </div>

            <hr>

            <div class="card p-2 mb-4">

                <form action="/nivel_acesso_adicionar" method="post">

                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="userID" value="<?php echo e($usuario->id); ?>">

                    <div class="mb-4">
                        <label for="recurso" class="form-label lblCaption">Selecione o recurso que deseja adionar</label>
                        <select class="form-control" name="recurso" id="recurso">

                            <option value="">Selecione uma opção</option>

                            <?php $__currentLoopData = $recursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recurso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($recurso); ?>"><?php echo e($recurso); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mb-4">
                        <i class="bi bi-floppy2"></i>
                        Adicionar regra</button>

                </form>

            </div>

            <div class="card pt-2 mt-4">

                <table class="table p-1">
                    <thead>
                        <tr>
                            <th scope="col">Recurso</th>
                            <th scope="col">Permitido</th>
                            <th scope="col">Operações</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php $__currentLoopData = $niveis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nivel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <td><?php echo e($nivel->recurso); ?> </td>
                                <td><?php echo e($nivel->permitido); ?> </td>

                                <td>

                                    <div>
                                        <div class="row">

                                            <?php if($nivel->permitido == 'sim'): ?>
                                                <div class="col-4">
                                                    <a href="<?php echo e(('/nivel_acesso_bloquear/'.$nivel->id)); ?>"
                                                        class="btn btn-danger btn-sm" title="Bloquear acesso a este recurso">
                                                        Bloquear
                                                        <i class="bi bi-ban"></i>
                                                    </a>
                                                </div>                                                
                                            <?php else: ?>
                                                <div class="col-4">
                                                    <a href="<?php echo e(('/nivel_acesso_liberar/'.$nivel->id)); ?>"
                                                        class="btn btn-warning btn-sm" title="Liberar acesso">
                                                        Liberar
                                                        <i class="bi bi-check-square-fill"></i>
                                                    </a>
                                                </div>                                            
                                            <?php endif; ?>

                                        </div>

                                    </div>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                </table>

                <div class="container-fluid pl-5 d-flex justify-content-center">
                    <?php echo e($niveis->links('pagination::pagination')); ?>

                </div>

            </div>

        </div>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/usuarios/acesso/usuarioNivelAcesso.blade.php ENDPATH**/ ?>