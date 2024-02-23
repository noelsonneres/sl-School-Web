<?php $__env->startSection('title', 'Alunos cadastrados'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Alunos cadastrados</h3>
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

            <a href="<?php echo e(route('alunos.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Novo </a>
            <button onclick="(print())" class="btn $teal-300">Imprimir</button>

        </div>

        <div class="col-8">

            <form action="/alunos_pesquisar" method="get">
                <?php echo csrf_field(); ?>

                <div class="row">

                    <div class="col-md-3">
                        <select class="form-control" name="opt" id="opt">
                            <option value="id">Código</option>
                            <option value="nome">Nome</option>
                            <option value="apelido">Apelido</option>
                            <option value="cpf">CPF</option>
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
                    <th scope="col">Nome</th>
                    <th scope="col">Apelido</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Ativo?</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>

                <?php $__currentLoopData = $alunos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aluno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($aluno->id); ?> </td>
                    <td><?php echo e($aluno->nome); ?> </td>
                    <td><?php echo e($aluno->apelido); ?> </td>
                    <td><?php echo e($aluno->telefone); ?> </td>
                    <td><?php echo e($aluno->celular); ?> </td>
                    <td><?php echo e($aluno->ativo); ?> </td>

                    <td>

                            <div class="row">                          

                                <div class="col-2">
                                    <a href="<?php echo e(route('alunos.edit', $aluno->id)); ?>" 
                                           title="Visualizar informações do alunos" class="btn btn-success btn-sm">
                                           <i class="bi bi-eye"></i>
                                    </a>
                                </div>

                                <div class="col-2">
                                    <a href="<?php echo e('/responsavel_adicionar/'.$aluno->id.'/'.$aluno->nome); ?>" 
                                           title="Responsável do aluno" class="btn btn-info btn-sm">
                                           <i class="bi bi-person-rolodex"></i>
                                    </a>
                                </div>

                                <div class="col-2">
                                    <a href="<?php echo e('/matricula_home/'.$aluno->id); ?>" 
                                           title="Informações sobre a matrícula" class="btn btn-primary btn-sm">
                                           <i class="bi bi-folder-plus"></i>
                                    </a>
                                </div>

                            </div>

                    </td>
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
               
            </tbody>
        </table>

        <div class="row">
            <div>
                <?php echo e($alunos->links('pagination::pagination')); ?>

            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/homeShow.blade.php ENDPATH**/ ?>