
<?php $__env->startSection('content'); ?>

	<div class="container">
		<div id="content">
        <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
            <?php endif; ?>
			<form action="<?php echo e(route('postlogin')); ?>" method="post" class="beta-form-checkout">
				<?php echo csrf_field(); ?>
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Đăng nhập</h4>
						<div class="space20">&nbsp;</div>

						
						<div class="form-block">
							<label for="email">Email address*</label>
							<input type="email" id="email" name="email" required>
						</div>
						<div class="form-block">
							<label for="password">Password*</label>
							<input type="password" id="password" name="password" required>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Login</button>
							<li><a href="<?php echo e(route('getInputEmail')); ?>">Quên mật khẩu</a></li>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
            
        <?php if(Session::has('flag')): ?>
        <div class="alert alert <?php echo e(Session::get('flag')); ?>"><?php echo e(Session::get('message')); ?></div>
        <?php endif; ?>
		</div> <!-- #content -->
	</div> <!-- .container -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\example-app\resources\views/user/dangnhap.blade.php ENDPATH**/ ?>