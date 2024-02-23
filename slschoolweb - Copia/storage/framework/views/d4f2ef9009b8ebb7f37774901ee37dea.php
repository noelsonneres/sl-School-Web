<?php $__env->startSection('title', 'Novo caixa'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Iniciar novo caixa</h3>
        </div>

        <hr>

        <div class="card p-5">

            <form action="<?php echo e(route('controle_caixa.store')); ?>" method="post">

                <?php echo csrf_field(); ?>

                <div class="card border ps-3 pt-4 pb-3 pe-3">

                    <h3 class="text-center pb-3">Informações do caixa anterior</h3>

                    <div class="row mb-4">

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
                            <label for="funcAbertura" class="form-label lblCaption">Func abertura</label>
                            <input type="text" class="form-control" name="funcAbertura"
                              id="funcAbertura" value="<?php echo e($caixa->funcionario_abertura); ?>">
                        </div>

                        <div class="col-md-2">
                            <label for="valorAnterior" class="form-label lblCaption">Valor anterior</label>
                            <input type="number" class="form-control" name="valorAnterior" id="valorAnterior"
                               value="<?php echo e($caixa->saldo_anterior); ?>"  readonly>
                        </div>

                        <div class="col-md-2">
                            <label for="valorInformado" class="form-label lblCaption">Valor informado</label>
                            <input type="number" class="form-control" name="valorInformado" id="valorInformado" 
                            value="<?php echo e($caixa->saldo_informado); ?>" readonly>
                        </div>

                    </div>

                    <hr>

                    <div class="row mb-4">

                      <div class="col-md-2">
                        <label for="dtEncerramento" class="form-label lblCaption">Data encerramento</label>
                        <input type="date" class="form-control" name="dtEncerramento" id="dtEncerramento" 
                           value="<?php echo e($caixa->data_encerramento); ?>" readonly>
                       </div>  

                       <div class="col-md-2">
                        <label for="hrEncerramento" class="form-label lblCaption">Hora encerramento</label>
                        <input type="time" class="form-control" name="hrEncerramento" id="hrEncerramento"
                           value="<?php echo e($caixa->hora_encerramento); ?>"  readonly>
                       </div>  

                       <div class="col-md-4">
                        <label for="funcEncerramento" class="form-label lblCaption">Func. Encerramento</label>
                        <input type="text" class="form-control" name="funcEncerramento" id="funcEncerramento" 
                           value="<?php echo e($caixa->funcionario_encerramento); ?>" readonly>
                       </div>

                       <div class="col-md-2">
                        <label for="saldoEncerramento" class="form-label lblCaption">Saldo</label>
                        <input type="number" class="form-control" name="saldoEncerramento" id="saldoEncerramento"
                            value="<?php echo e($caixa->saldo_encerramento); ?>" readonly>
                       </div>  

                       <div class="col-md-2">
                        <label for="status" class="form-label lblCaption">Status</label>
                        <input style="color: red" type="text" class="form-control" name="status" id="status"
                            value="<?php echo e($caixa->status); ?>" readonly>
                       </div>  

                    </div>

                    <div class="mb-4">
                        <label for="obs" class="form-label lblCaption">Observação</label>
                        <input type="text" class="form-control" name="obs" id="obs" maxlength="255"
                         value="<?php echo e($caixa->observacao); ?>" readonly>
                    </div>

                </div>

                <div class="card border ps-3 pt-4 pb-3 pe-3">
                    
                    <h3 class="text-center pb-3">Informações do novo caixa</h3>

                    <div class="row mb-4">

                        <div class="col-md-2">
                            <label for="dtAberturaAtual" class="form-label lblCaption">Data de abertura</label>
                            <input type="date" class="form-control" name="dtAberturaAtual" id="dtAberturaAtual"
                            value="<?php echo e(\Carbon\Carbon::now()->toDateString()); ?>">
                        </div>

                        <div class="col-md-2">
                            <label for="hrAberturaAtual" class="form-label lblCaption">Horário de abertura</label>
                            <input type="time" class="form-control" name="hrAberturaAtual" id="hrAberturaAtual"
                                value="<?php echo e(\Carbon\Carbon::now()->toTimeString()); ?>">
                        </div>

                        <div class="col-md-4">
                            <label for="funcAberturaAtual" class="form-label lblCaption">Func abertura</label>
                            <input type="text" class="form-control" name="funcAberturaAtual" id="funcAberturaAtual">
                        </div>

                        <div class="col-md-2">
                            <label for="valorAnteriorAtual" class="form-label lblCaption">Valor anterior</label>
                            <input type="number" class="form-control" name="valorAnteriorAtual" id="valorAnteriorAtual" 
                            id="valor" step="0.01" min="0.01" value="<?php echo e($caixa->saldo_encerramento); ?>" readonly>
                        </div>

                        <div class="col-md-2">
                            <label for="valorInformadoAtual" class="form-label lblCaption">Valor informado</label>
                            <input type="number" class="form-control" name="valorInformadoAtual" id="valorInformadoAtual"
                            id="valor" step="0.01" min="0.01" required>
                        </div>

                    </div>  
                    
                    <div class="mb-4">
                        <label for="obsAtual" class="form-label lblCaption">Observação</label>
                        <input type="text" class="form-control" name="obsAtual" id="obsAtual" maxlength="255">
                    </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Iniciar novo caixa</button>

                    <a href="/" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/controleCaixa/caixaNovo.blade.php ENDPATH**/ ?>