<?php $__env->startSection('title'); ?>Profile Details <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="col-md-4 offset-md-4">
            <div class="card card-default">
                <div class="card-header text-center">
                    <span class="pull-left">Edit your profile</span>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('profile.update', ['username' => Auth::user()->username])); ?>" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group row">
                            <label for="cover" class="col-md-4 col-form-label text-md-right">Cover image</label>

                            <div class="col-md-6">
                                <input id="cover" type="file" class="form-control" name="cover">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">Avatar image</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control" name="avatar">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>

                            <div class="col-md-6">
                                <select class="form-control" name="gender" id="gender">
                                    <?php if(Auth::user()->gender == 1): ?>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    <?php else: ?>
                                        <option value="0">Female</option>
                                        <option value="1">Male</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e($user->name); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="about" class="col-md-4 col-form-label text-md-right">Something about me</label>

                            <div class="col-md-6">
                                <textarea id="about" type="text" class="form-control" name="about"
                                          ><?php echo e($user->profile->about); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profession" class="col-md-4 col-form-label text-md-right">Profession</label>

                            <div class="col-md-6">
                                <input id="profession" type="text" class="form-control" name="profession"
                                       value="<?php echo e($user->profile->profession); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location"
                                       value="<?php echo e($user->profile->location); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-7 offset-3">
                                <input class="btn btn-primary btn-block" type="submit" value="Update details" name="submit">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>