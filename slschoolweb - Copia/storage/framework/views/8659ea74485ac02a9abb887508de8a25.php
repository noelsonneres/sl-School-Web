<?php $__env->startSection('title', 'Finalizar caixa atual'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Finalizar o caixa atual</h3>
        </div>

        <hr>

        <div class="card p-5">

            <form action="<?php echo e(route('controle_caixa.update', $caixa->id)); ?>" method="post">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="card border mb-4 ps-3 pe-3 pt-4 pb-4">

                    <h4 class="mb-4">Informações de abertura</h4>

                    <div class="row">

                        <div class="col-md-2">
                            <label for="dtAbertura" class="form-label lblCaption">Data de abertura</label>
                            <input type="date" class="form-control" name="dtAbertura" id="dtAbertura"
                                   value="<?php echo e($caixa->data_abertura); ?>" readonly>
                        </div>

                        <div class="col-md-2">
                            <label for="hrAbertura" class="form-label lblCaption">Horário de abertura</label>
                            <input type="time" class="form-control" name="hrAbertura" id="hrAbertura"
                                   value="<?php echo e($caixa->hora_abertura); ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="funcionario" class="form-label lblCaption">Funcionário</label>
                            <input type="text" class="form-control" name="funcionario" id="funcionario"
                                   readonly maxlength="100">
                        </div>

                        <div class="col-md-2">
                            <label for="valorAnterior" class="form-label lblCaption">Valor anterior</label>
                            <input type="number" class="form-control" name="valorAnterior" id="valorAnterior"
                                   value="<?php echo e($caixa->saldo_anterior); ?>" readonly>
                        </div>

                        <div class="col-md-2">
                            <label for="valorInformado" class="form-label lblCaption">Valor informado</label>
                            <input type="number" class="form-control" name="valorInformado" id="valorInformado"
                                   value="<?php echo e($caixa->saldo_informado); ?>" readonly>
                        </div>

                    </div>

                </div>

                <div class="card border mb-4 ps-3 pe-3 pt-4 pb-4">

                    <h4 class="mb-4">Informações de encerramento</h4>

                    <div class="row mb-4">

                        <div class="col-md-2">
                            <label for="dtEncerramento" class="form-label lblCaption">Data de encerramento</label>
                            <input type="date" class="form-control" name="dtEncerramento" id="dtEncerramento"
                                   value="<?php echo e(\Carbon\Carbon::now()->format('Y-m-d')); ?>" required>
                        </div>

                        <div class="col-md-2">
                            <label for="hrEncerramento" class="form-label lblCaption">HR. encerramento</label>
                            <input type="time" class="form-control" name="hrEncerramento" id="hrEncerramento"
                                 required>
                            <script>
                                document.getElementById('hrEncerramento').value = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                            </script>
                        </div>

                        <div class="col-md-4">
                            <label for="funcEncerramento" class="form-label lblCaption">Funcionário Encerramennto</label>
                            <input type="text" class="form-control" name="funcEncerramento" id="funcEncerramento" maxlength="100">
                        </div>

                        <div class="col-md-2">
                            <label for="saldoEncerramento" class="form-label lblCaption">Saldo de encerramento</label>
                            <input type="number" class="form-control" name="saldoEncerramento" id="saldoEncerramento"
                                   value="<?php echo e($total); ?>" required>
                        </div>

                        <div class="col-md-2">
                            <label for="status" class="form-label lblCaption">Status</label>
                            <input type="text" class="form-control" name="status" id="status" readonly>
                        </div>

                    </div>

                    <div class="mb-4">
                        <label for="obs" class="form-label lblCaption">Observação</label>
                        <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
                    </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Finalizar
                    </button>

                    <a href="/dias" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/controleCaixa/caixaFinalizar.blade.php ENDPATH**/ ?>