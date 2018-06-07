<?php $__env->startSection('title'); ?>Friends <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid spacing">
        <div class="row">
            <div class="card col-md-5 offset-3" style="padding: 20px;">
                <div class="card-header text-center">List of all friends</div>
                <?php $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="img-thumbnail spacing friend-row"
                       href="<?php echo e(route('profile', ['username' => $friend->username ])); ?>">
                        <img src="<?php echo e($friend->avatar); ?>" alt="" width="40px" height="40px"> <?php echo e($friend->name); ?>

                        <?php $__currentLoopData = $friendships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friendship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="float-right">
                                <?php if($friendship->requested_user == $friend->id || $friendship->requester == $friend->id ): ?>
                                    Friends since: <?php echo e($friendship->created_at->diffForHumans()); ?>

                                <?php endif; ?>
                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>