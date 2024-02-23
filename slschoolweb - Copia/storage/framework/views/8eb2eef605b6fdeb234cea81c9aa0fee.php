<?php $__env->startSection('title', 'Informações da matrícula'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Informações da matrícula</h3>
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

            <div class="col-md-7 ms-3">
                <h4>Aluno(a): <?php echo e($aluno->nome); ?></h4>
                <h4>Matrícula: <?php echo e($matricula->id); ?></h4>
                <h5>Curso: <?php echo e($matricula->cursos->curso); ?></h5>

                <?php if($matricula->status == 'sim' or $matricula->status == 'ativa'): ?>
                    <h5 style="color: green; font-weight: 700">Situação: <?php echo e($matricula->status); ?></h5>
                <?php elseif($matricula->status == 'cancelada' or $matricula->status == 'trancada'): ?>
                    <h5 style="color: red; font-weight: 700">Situação: <?php echo e($matricula->status); ?></h5>
                <?php elseif($matricula->status == 'finalizada'): ?>
                    <h5 style="color: blue; font-weight: 700">Situação: <?php echo e($matricula->status); ?></h5>
                <?php endif; ?>

            </div>

            <div class="col-md-4">

                <a href="<?php echo e('/matricula_adicionar/' . $aluno->id); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Nova Matrícula </a>

            </div>

        </div>

        <hr>

        <div class="container">

            <div class="row">

                <div class="col-sm-2">
                    <a href="<?php echo e(route('matricula.edit', $matricula->id)); ?>" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(14, 156, 14); font-weight: 500;">Matricula</h2>
                                <i class="bi bi-person-vcard" style="font-size: 70px; color: rgb(14, 156, 14);"></i>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-sm-2">
                    <a href="<?php echo e('/turmas_matricula_lista/' . $matricula->alunos_id . '/' . $matricula->id); ?>"
                        class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(14, 59, 156); font-weight: 500;">Turmas</h2>
                                <i class="bi bi-person-video3" style="font-size: 70px; color: rgb(14, 59, 156);"></i>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-sm-2">
                    <a href="<?php echo e(route('mensalidades.show', $matricula->id)); ?>" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color:color: rgb(86, 6, 74); font-weight: 500;">Mensalidades</h2>
                                <i class="bi bi-currency-dollar" style="font-size: 70px; color: rgb(86, 6, 74);"></i>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-sm-2">
                    <a href="<?php echo e(route('matricula_materiais.show', $matricula->id)); ?>" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(246, 83, 97); font-weight: 500;">Materiais</h2>
                                <i class="bi bi-journal-check" style="font-size: 70px; color: rgb(246, 83, 97);"></i>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-sm-2">
                    <a href="<?php echo e(route('matricula_disciplina.show', $matricula->id)); ?>" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(204, 127, 44); font-weight: 500;">Disciplinas</h2>
                                <i class="bi bi-journals" style="font-size: 70px; color: rgb(204, 127, 44);"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-2">
                    <div class="card" style="display: flex; justify-content: center; align-items: center;">
                        <div class="card-body text-center">
                            <h2 class="text-primary" style="font-weight: 500;">Contrato</h2>
                            <i class="bi bi-file-text text-primary" style="font-size: 70px;"></i>
                        </div>
                    </div>
                </div>

            </div>

            <hr>

            <div class="row">

                <div class="col-sm-2">
                    <a href="<?php echo e(route('responsavel.edit', $matricula->responsavels_id)); ?>" class="link-card">
                    <div class="card" style="display: flex; justify-content: center; align-items: center;">
                        <div class="card-body text-center">
                            <h2 class="text-primary" style="font-weight: 500;">Responsável</h2>
                            <i class="bi bi-person-gear text-primary" style="font-size: 70px;"></i>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-sm-3">
                    <a href="<?php echo e(route('alunos.edit', $matricula->alunos_id)); ?>" class="link-card">
                    <div class="card" style="display: flex; justify-content: center; align-items: center;">
                        <div class="card-body text-center">
                            <h2 style="font-weight: 500; color: rgb(8, 51, 4)">Dados do aluno</h2>
                            <i class="bi bi-person-gear" style="font-size: 70px; color: rgb(8, 51, 4);"></i>
                        </div>
                    </div>
                    </a>
                </div>

                <hr>

            </div>

            <div class="row">

                <div class="col-sm-2">
                    <a href="<?php echo e(route('frequencia.show', $matricula->id)); ?>" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(14, 156, 14); font-weight: 500;">Frequência</h2>
                                <i class="bi bi-person-vcard" style="font-size: 70px; color: rgb(14, 156, 14);"></i>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-sm-2">
                    <a href="<?php echo e(route('reposicoes.show', $matricula->id)); ?>" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(14, 59, 156); font-weight: 500;">Resposição</h2>
                                <i class="bi bi-person-vcard" style="font-size: 70px; color: rgb(14, 59, 156);"></i>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            <hr>

            
            <div class="row">

                <div class="col-sm-2">
                    <a href="<?php echo e('/cancelar_matricula/' . $matricula->id); ?>" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(156, 42, 14); font-weight: 500;">Cancelar</h2>
                                <i class="bi bi-person-x" style="font-size: 70px; color:  rgb(156, 42, 14); "></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-2">
                    <a href="<?php echo e(route('trancar_matricula.show', $matricula->id)); ?>" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(235, 65, 23); font-weight: 500;">Trancar</h2>
                                <i class="i bi-person-fill-exclamation"
                                    style="font-size: 70px; color:  rgb(235, 65, 23); "></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-2">
                    <a href="<?php echo e(route('matricula_finalizar.show', $matricula->id)); ?>" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(40, 39, 34); font-weight: 500;">Finalizar</h2>
                                <i class="bi bi-person-check-fill" style="font-size: 70px; color:  rgb(40, 39, 34); "></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-2">
                    <a href="<?php echo e(route('matricula_reativar.show', $matricula->id)); ?>" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(28, 76, 6); font-weight: 500;">Reativar</h2>
                                <i class="bi bi-person-plus-fill" style="font-size: 70px; color:  rgb(28, 76, 6); "></i>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

        </div>


    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/matricula/matriculaHome.blade.php ENDPATH**/ ?>