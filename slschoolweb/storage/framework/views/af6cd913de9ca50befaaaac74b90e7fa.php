<?php $__env->startSection('title', 'Turmas Disponíveis'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Turmas disponíveis</h4>
        </div>

        <div class="row p-2">

            <div class="col md-4">
                <h4>Aluno(a): <?php echo e($matricula->alunos->nome); ?></h4>
            </div>

            <div class="col-md-2">
                <h4>Matricula: <?php echo e($matricula->id); ?></h4>
            </div>

            <div class="col-md-6">
                <h4>Curso: <?php echo e($matricula->cursos->curso); ?></h4>
            </div>

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

                <a href="<?php echo e(route('salas.create')); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Novo</a>
                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

            <div class="col-8">

                <form action="/sala_pesquisar" method="get">
                    <?php echo csrf_field(); ?>

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="id">Código</option>
                                <option value="sala">Sala</option>
                                <option value="descricao">Descrição</option>
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
                    <th scope="col">Turma</th>
                    <th scope="col">Dias</th>
                    <th scope="col">Horários</th>
                    <th scope="col">Sala</th>
                    <th scope="col">Operação</th>
                </tr>
                </thead>


                <tbody>
                <?php $__currentLoopData = $turmas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $turma): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($turma->id); ?> </td>
                        <td><?php echo e($turma->turma); ?>  </td>
                        <td><?php echo e($turma->cadastroDias->dia1); ?> - <?php echo e($turma->cadastroDias->dia2); ?></td>
                        <td><?php echo e($turma->cadastroHorarios->entrada); ?> - <?php echo e($turma->cadastroHorarios->saida); ?></td>
                        <td><?php echo e($turma->sala->sala); ?> - <?php echo e($turma->sala->vagas); ?></td>

                        <td>
                            <div class="col-3">
                                <a href="<?php echo e(('/reposicao_selecionar/'.$matricula->id.'/'.$turma->id)); ?>" class="btn btn-info btn-sm "
                                    title="Selecionar turma para reposição">
                                    <i class="bi bi-check-square-fill"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>


            </table>

            <div class="container-fluid pl-5 d-flex justify-content-center">
                <?php echo e($turmas->links('pagination::pagination')); ?>

            </div>

        </div>


    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/reposicao/listarTurmasDisponiveis.blade.php ENDPATH**/ ?>