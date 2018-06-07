<?php $__env->startSection('title'); ?>Notifications <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card spacing">
                    <div class="card-header">Notifications</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item">
                                    <a href="/profile/<?php echo e($notification->data['username']); ?>">
                                        <?php echo e($notification->data['name']); ?>

                                    </a>
                                    <?php echo e($notification->data['message']); ?>

                                    <span class="float-right"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>