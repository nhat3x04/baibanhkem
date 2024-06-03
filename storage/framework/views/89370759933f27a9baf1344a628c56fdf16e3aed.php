<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
</head>
<body>
    <!-- sentData được truyền từ app\Mail\SendMail.php -->
    <h1><?php echo e($sentData['title']); ?></h1>
    <p><?php echo e($sentData['body']); ?></p>
</body>
</html><?php /**PATH C:\xampp\htdocs\example-app\resources\views/emails/interfaceEmail.blade.php ENDPATH**/ ?>