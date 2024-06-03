

<?php $__env->startSection('content'); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <h1 class="page-header">Trả lời liên hệ</h1>
        <form action="<?php echo e(route('contacts.reply', $contact->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="subject">Chủ đề</label>
                <input type="text" name="subject" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="message">Nội dung</label>
                <textarea name="message" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layoutadmin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\example-app\resources\views/contacts/reply.blade.php ENDPATH**/ ?>