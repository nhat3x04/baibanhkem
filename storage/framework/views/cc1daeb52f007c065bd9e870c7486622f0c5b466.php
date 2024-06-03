

<?php $__env->startSection('content'); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <h1 class="page-header">Danh sách liên hệ</h1>
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Nội dung</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($contact->id); ?></td>
                    <td><?php echo e($contact->name); ?></td>
                    <td><?php echo e($contact->email); ?></td>
                    <td><?php echo e($contact->message); ?></td>
                    <td><?php echo e($contact->status == 'pending' ? 'Chưa trả lời' : 'Đã trả lời'); ?></td>
                    <td>
                        <a href="<?php echo e(route('contacts.showReplyForm', $contact->id)); ?>" class="btn btn-primary">Trả lời</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layoutadmin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\example-app\resources\views/contacts/index.blade.php ENDPATH**/ ?>