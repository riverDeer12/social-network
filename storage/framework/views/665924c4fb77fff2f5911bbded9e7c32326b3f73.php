<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>SocialNetwork - <?php echo $__env->yieldContent('title'); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">
</head>

<body>
<div id="app">
    <init></init>
    <?php echo $__env->make('includes.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php if(Auth::check()): ?>
        <notification :id="<?php echo e(Auth::user()->id); ?>"></notification>
    <?php endif; ?>
    <audio id="notification_sound">
        <source src="<?php echo e(asset('audio/notification.mp3')); ?>">
    </audio>
</div>


<!-- Scripts -->
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
</body>
</html>