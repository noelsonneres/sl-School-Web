
<?php $__env->startSection('title', 'Usuários cadastrados'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Usuários cadastrados</h4>
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

                <a href="<?php echo e(route('usuarios.create')); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Novo</a>
                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

            <div class="col-8">

                <form action="/usuarios_localizar" method="get">
                    <?php echo csrf_field(); ?>

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="id">Código</option>
                                <option value="name">Nome</option>
                                <option value="user_name">Usuário</option>
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

            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Ativo</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>


                <tbody>
                    <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($usuario->id); ?> </td>
                            <td><?php echo e($usuario->name); ?> </td>
                            <td><?php echo e($usuario->user_name); ?> </td>
                            <td><?php echo e($usuario->email); ?> </td>

                            <?php if($usuario->ativo == '1'): ?>
                                <td>Sim</td>
                            <?php else: ?>
                                <td>Não</td>
                            <?php endif; ?>

                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="<?php echo e(route('usuarios.edit', $usuario->id)); ?>"
                                                class="btn btn-success btn-sm" title="Atualizar informações do usuário">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </div>

                                        <?php if($usuario->ativo == '1'): ?>
                                            <div class="col-2">
                                                <a href="<?php echo e(route('nivel_acesso.show', $usuario->id)); ?>"
                                                    class="btn btn-info btn-sm" title="Níveis de acesso">
                                                    <i class="bi bi-lock"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <div class="col-2">

                                            <form method="POST" class="delete-form"
                                                action="<?php echo e(route('usuarios.destroy', $usuario->id)); ?>">
                                                <?php echo csrf_field(); ?>
                                                
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    title="Deletar usuãrio selecionado" onclick="confirmDelete(this)">
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

            <div class="container-fluid pl-5 d-flex justify-content-center">
                <?php echo e($usuarios->links('pagination::pagination')); ?>

            </div>

        </div>



    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/usuarios/usuarioShow.blade.php ENDPATH**/ ?>