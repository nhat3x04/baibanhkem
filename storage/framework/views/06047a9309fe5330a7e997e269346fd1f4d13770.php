<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="pull-left auto-width-left">
					<ul class="top-menu menu-beta l-inline">
						<li><a href=""><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
						<li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
					</ul>
				</div>
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">
						<li><a href="#"><i class="fa fa-user"></i>Tài khoản</a></li>
						<?php if(Auth::check()): ?>
                            <li><a href="#"><i class="fa fa-user"></i>Chào bạn <?php echo e(Auth::user()->full_name); ?></a></li>
                            <li><a href="<?php echo e(route('getlogout')); ?> "><i class="fa fa-user"></i>Đăng xuất</a></li>
                        <?php else: ?>
                        <li><a href="<?php echo e(route('getsignin')); ?>">Đăng kí</a></li>
                        <li><a href="<?php echo e(route('getlogin')); ?>">Đăng nhập</a></li>
                        <?php endif; ?>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="index.html" id="logo"><img src="/source/assets/dest/images/logo-cake.png" width="200px" alt=""></a>
				</div>
				<div class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="/">
					        <input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." />
					        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>

					<div class="beta-comp">
                        <?php if(Session::has('cart')): ?>
                        <div class="cart">
                            <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (<?php if(Session::has('cart')): ?><?php echo e(Session('cart')->totalQty); ?>

                                <?php else: ?> Trống <?php endif; ?>) <i class="fa fa-chevron-down"></i></div>
                           
                                <div class="beta-dropdown cart-body">
                                    <?php $__currentLoopData = $productCarts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="cart-item">
                                        <a class="cart-item-delete" href="<?php echo e(route('banhang.xoagiohang',$product['item']['id'])); ?>"><i class="fa fa-times"></i>
                                        </a>
                                        <div class="media">
                                            <a class="pull-left" href="#"><img src="/source/image/product/<?php echo e($product['item']['image']); ?>" alt=""></a>
                                            <div class="media-body">
                                                <span class="cart-item-title"><?php echo e($product['item']['name']); ?></span>
												<span class="cart-item-amount"><?php echo e($product['qty']); ?>*<span>
                                                    <?php if($product['item']['promotion_price']==0): ?>
                                                    <?php echo e(number_format($product['item']['unit_price'])); ?><?php else: ?>
                                                    <?php echo e(number_format($product['item']['promotion_price'])); ?>

                                                    <?php endif; ?>
                                                </span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <div class="cart-caption">
                                        <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value"><?php echo e($cart->totalPrice); ?></span></div>
                                        <div class="clearfix"></div>

                                        <div class="center">
                                            <div class="space10">&nbsp;</div>
                                            <a href="<?php echo e(route('banhang.getdathang')); ?>" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                        </div> <!-- .cart -->
                        <?php endif; ?>
                    </div>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom" style="background-color: #0277b8;">
			<div class="container">
				<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a href="index">Trang chủ</a></li>
						<li><a href="#">Sản phẩm</a>
							<ul class="sub-menu">
								<li><a href="product_type.html">Sản phẩm 1</a></li>
								<li><a href="product_type.html">Sản phẩm 2</a></li>
								<li><a href="product_type.html">Sản phẩm 4</a></li>
							</ul>
						</li>
						<li><a href="about.html">Giới thiệu</a></li>
						<li><a href="contact">Liên hệ</a></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div> <!-- #header --><?php /**PATH C:\xampp\htdocs\example-app\resources\views/layout/header.blade.php ENDPATH**/ ?>