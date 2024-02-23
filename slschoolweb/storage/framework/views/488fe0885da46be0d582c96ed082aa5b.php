
<?php $__env->startSection('title', 'Modelo de contrato'); ?>
<?php $__env->startSection('content'); ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://cdn.tiny.cloud/1/bbjex0u60g9l82u6f89sehnxo5muk831ojo2do93kqw1ud7s/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script src="/tinymce/langs/pt_BR.js"></script>
        <script>
            tinymce.init({
                selector: '#contrato',
                language: 'pt_BR',
            });
        </script>
    </head>

    <body>

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-2">Atualizar informações do contrato</h3>
        </div>

        <hr>
        <?php if(isset($msg)): ?>
            <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                                justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5><?php echo e($msg); ?> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo e(route('contrato.update', $contrato->id)); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <input type="hidden" name="contratoID" value="<?php echo e($contrato->id); ?>">

            <div class="mb-4 mt-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" name="descricao" id="descricao" maxlength="100"
                    value="<?php echo e($contrato->descricao); ?>">
            </div>

            <textarea id="contrato" name="contrato" style="height: 800px">
        <?php echo e($contrato->contrato); ?>

    </textarea>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-floppy2"></i>
                    Salvar</button>

                <a href="javascript:history.back()" class="btn btn-danger">
                    <i class="bi bi-x-circle-fill"></i>
                    Cancelar</a>
            </div>

        </form>
    </body>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/editorContrato/contratosEdit.blade.php ENDPATH**/ ?>