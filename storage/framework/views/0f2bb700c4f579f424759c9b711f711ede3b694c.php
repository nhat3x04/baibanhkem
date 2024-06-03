
<?php $__env->startSection('content'); ?>
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <?php if(isset($products)): ?>
                        <?php
                        $products=$products
                            ?>
                            <?php endif; ?>  
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <form action="<?php echo e(route('products.destroy',['id'=>$product->id])); ?>" method="post">
                        <?php echo csrf_field(); ?>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                          
                        <?php echo method_field('delete'); ?>
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>unit_price</th>
                                <th>promotion_price</th>
                                <th>description</th>
                                <th>unit</th>
                                <th>new</th>
                                <th>image</th>
                                <th style="witdh:90px;">Chức năng</th>

                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX" align="center">
                                <td><?php echo e($product -> id); ?></td>
                                <td><?php echo e($product -> name); ?></td>
                                <td><?php echo e($product -> unit_price); ?></td>
                                <td><?php echo e($product -> promotion_price); ?></td>
                                <td><?php echo e($product ->description); ?></td>
                                <td><?php echo e($product ->unit); ?></td>
                                <td><?php echo e($product ->new); ?></td>
                                <td><img src="/source/image/product/<?php echo e($product->image); ?>" alt="" witdh="80px"height="80px"></td>

                                
                                <td class="center"><i class="fa fa-pencil fa-fw"></i><a style="background-color:yellow; min-width:90px; border:1px black solid;" href="<?php echo e(route('products.edit', ['id' => $product->id])); ?>"> Edit</a><br>
                                <i class="fa fa-trash-o  fa-fw"><input style="background-color:red;min-width:50px;" type="submit" value="Delete"></td>
                            </tr>
                           
                        </tbody>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </table>
                    <?php echo e($products->onEachSide(7)->links()); ?>

                    </form>
                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <?php $__env->stopSection(); ?>

    <style>
        th, td{
            text-align: center;
        }
        th{
            width :80px;
        }
        .fa{
            /* color: white */
        }
        </style>
<?php echo $__env->make('layoutadmin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\example-app\resources\views/admin/list.blade.php ENDPATH**/ ?>