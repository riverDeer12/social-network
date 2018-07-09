<?php $__env->startSection('title'); ?>My Profile <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-header text-center"
                         style="background: url(<?php echo e(Storage::url( $user->cover )); ?>); background-size: cover;">
                        <img class="img-responsive profile-img" src="<?php echo e($user->avatar); ?>" width="150px"
                             height="150px">
                    </div>
                    <div class="card-body text-center">
                        <p>Name: <?php echo e($user->name); ?></p>
                        <p>Location:
                            <?php if($user->profile->location == NULL): ?>
                                <?php if(Auth::user()->id == $user->id): ?>
                                    <a href="<?php echo e(route('profile.edit', ['username' => Auth::user()->username])); ?>">Edit
                                        your
                                        location</a>
                                <?php else: ?>
                                    No info about location.
                                <?php endif; ?>
                            <?php else: ?>
                                <?php echo e($user->profile->location); ?>

                            <?php endif; ?>
                        </p>
                        <p>Profession:
                            <?php if($user->profile->profession == NULL): ?>
                                <?php if(Auth::user()->id == $user->id): ?>
                                    <a href="<?php echo e(route('profile.edit', ['username' => Auth::user()->username])); ?>">Edit
                                        your
                                        profession</a>
                                <?php else: ?>
                                    No info about profession.
                                <?php endif; ?>
                            <?php else: ?>
                                <?php echo e($user->profile->profession); ?>

                            <?php endif; ?>
                        </p>
                        <p>Age: <?php echo e($user->dob->age); ?> years old</p>
                        <p>Gender:
                            <?php if($user->gender == 1): ?>
                                Male
                            <?php else: ?>
                                Female
                            <?php endif; ?>
                        </p>
                        <span class="form-control text-center">
                            <?php if(Auth::user()->id == $user->id): ?>
                                <?php if($user->profile->about == NULL): ?>
                                    <a href="<?php echo e(route('profile.edit', ['username' => Auth::user()->username])); ?>">Write something about yourself</a>
                                <?php else: ?>
                                    <span><?php echo e($user->profile->about); ?></span>
                                <?php endif; ?>
                            <?php elseif($user->profile->about == NULL): ?>
                                <span>No further description.</span>
                            <?php else: ?>
                                <span><?php echo e($user->profile->about); ?></span>
                            <?php endif; ?>
                        </span>
                        <?php if(Auth::user()->id == $user->id): ?>
                            <span class="float-right">
                                <a href="<?php echo e(route('profile.edit', ['username' => Auth::user()->username])); ?>">Edit your details</a>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Users friends -->
                    <my-friends :user_id="<?php echo e($user->id); ?>" :username="'<?php echo e($user->username); ?>'"></my-friends>

                </div>
                <!-- Users relationship -->
                <friend :profile_user_id="<?php echo e($user->id); ?>"></friend>
            </div>

            <div class="col-md-4 text-center">
                <button type="button" class="btn btn-success btn-lg spacing" data-toggle="modal" data-target="#createPostModal">
                    Do you want to post something?
                </button>
                <!-- Wall posts -->
                <wall :user_id="<?php echo e($user->id); ?>"></wall>
            </div>

            <!-- New post modal -->
            <div class="modal fade" id="createPostModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Post something great !</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <create-post></create-post>
                        </div>
                    </div>

                </div>
            </div>


            <!-- Flash message -->
            <div class="col-md-3">
                <div class="pull-right">
                    <div class="flash-message">
                        <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(Session::has('alert-' . $message)): ?>

                                <p class="alert alert-<?php echo e($message); ?>"><?php echo e(Session::get('alert-' . $message)); ?> <a
                                            href="#"
                                            class="close"
                                            data-dismiss="alert"
                                            aria-label="close">&times;</a>
                                </p>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>