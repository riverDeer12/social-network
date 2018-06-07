<?php $__env->startSection('title'); ?>Messages <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid spacing">
        <div class="row">
            <h3>Messenger</h3>
        </div>
        <div class="col-md-10">
            <messenger :user_id="<?php echo e(Auth::user()->id); ?>"></messenger>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>