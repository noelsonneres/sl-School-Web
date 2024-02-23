<?php $__env->startSection('title', 'Atualizar Informações da turma'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Atualizar Informações da turma</h3>
        </div>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <hr>

        <div class="card p-5">

            <form action="<?php echo e(route('turma.update', $turmas->id)); ?>" method="post">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="turma" class="form-label lblCaption">Turma</label>
                    <input type="text" class="form-control" name="turma" id="turma" maxlength="100" autofocus
                        required autocomplete="off" value="<?php echo e($turmas->turma); ?>">
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label lblCaption">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" autocomplete="off"
                        value="<?php echo e($turmas->descricao); ?>">
                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label for="dias" class="form-label lblCaption">Dias</label>
                        <select class="form-control" name="dias" id="dias">
                            <option value="<?php echo e($turmas->cadastroDias->id); ?>"><?php echo e($turmas->cadastroDias->dia1); ?>

                                - <?php echo e($turmas->cadastroDias->dia2); ?></option>

                            <?php $__currentLoopData = $dias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($dia->id); ?>"><?php echo e($dia->dia1); ?> - <?php echo e($dia->dia2); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="horarios" class="form-label lblCaption">Horários</label>
                        <select class="form-control" name="horarios" id="horarios">

                            <option value="<?php echo e($turmas->cadastroHorarios->id); ?>"><?php echo e($turmas->cadastroHorarios->entrada); ?>

                                às
                                <?php echo e($turmas->cadastroHorarios->saida); ?></option>

                            <?php $__currentLoopData = $horarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $horario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($horario->id); ?>"><?php echo e($horario->entrada); ?> às <?php echo e($horario->saida); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="sala" class="form-label lblCaption">Sala</label>
                        <select class="form-control" name="sala" id="sala">

                            <option value="<?php echo e($turmas->sala->id); ?>"><?php echo e($turmas->sala->sala); ?></option>

                            <?php $__currentLoopData = $salas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sala): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sala->id); ?>"><?php echo e($sala->sala); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="professor" class="form-label lblCaption">Professor</label>
                        <select class="form-control" name="professor" id="professor">

                            <?php if(isset($turmas->professor->id)): ?>
                                <option value="<?php echo e($turmas->professor->id); ?>"><?php echo e($turmas->professor->nome); ?></option>
                            <?php endif; ?>

                            <?php $__currentLoopData = $professores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $professor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($professor->id); ?>"><?php echo e($professor->nome); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="turno" class="form-label lblCaption">Turno</label>
                        <select class="form-control" name="turno" id="turno">

                            <option value="<?php echo e($turmas->turno); ?>"><?php echo e($turmas->turno); ?></option>
                            <option value="matutino">Matutino</option>
                            <option value="vespertino">Vespertino</option>
                            <option value="noturno">Noturno</option>
                            <option value="outros">Outros</option>

                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="ativa" class="form-label lblCaption">Ativa</label>
                        <select class="form-control" name="ativa" id="ativa">

                            <option value="<?php echo e($turmas->ativa); ?>"><?php echo e($turmas->ativa); ?></option>
                            <option value="sim">Sim</option>
                            <option value="nao">Não</option>

                        </select>
                    </div>

                </div>

                <div class="mb-3">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" id="obs" name="obs" maxlength="255"
                        value="<?php echo e($turmas->obs); ?>">
                </div>


                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/turma" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>





















<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/turmas/turmasEdit.blade.php ENDPATH**/ ?>