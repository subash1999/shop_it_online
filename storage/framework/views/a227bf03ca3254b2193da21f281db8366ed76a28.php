
<?php echo $__env->make('public/layout/js_public_header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<header class="header">

	<!-- Top Bar -->

	<div class="top_bar">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-row">
					<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="<?php echo e(asset('one_tech/images/phone.png')); ?>" alt=""></div>+977 9846055581</div>
					<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="<?php echo e(asset('one_tech/images/mail.png')); ?>" alt=""></div><a href="mailto:subash.niroula4455@gmail.com">subash.niroula4455@gmail.com</a></div>
					<div class="top_bar_content ml-auto">
						<div class="top_bar_menu">
							<ul class="standard_dropdown top_bar_dropdown">							
								<li>
									<a href="javascript:void(0)" id="selected_currency">$ US dollar<i class="fas fa-chevron-down"></i></a>
									<ul class="currency_options">
										
									</ul>
								</li>
							</ul>
						</div>	
						<?php
						if(Auth::check()){
							if(Auth::user()->isSeller()){
								?>	
								<div class="top_bar_menu">
									<ul class="standard_dropdown top_bar_dropdown">						
										<li>
											<?php
											if(Auth::check()){	
												if(Auth::user()->isSeller()){
													?>
													<a href="javascript:void(0)" id="selected_currency">Seller<i class="fas fa-chevron-down"></i></a>

													<ul id="currency_options">									
														<?php if(auth()->guard()->check()): ?>											
														<?php if(Auth::user()->isSeller()): ?>
														<li><a href="<?php echo e(url('/seller/dashboard')); ?>">Seller Dashboard</a></li>
														<li><a href="<?php echo e(url('/seller/dashboard/new_product')); ?>">Add New Product</a></li>
														<?php endif; ?>
														<?php endif; ?>

														<?php if(auth()->guard()->guest()): ?>
														<li><a href="<?php echo e(url("seller/register/step1")); ?>">Seller Register</a></li>
														<li><a href="<?php echo e(url("/login")); ?>">Seller Login</a></li>
														<?php endif; ?>										
													</ul>
													<?php
												}
											}
											else{
												?>
												<a href="javascript:void(0)" id="selected_currency">Seller<i class="fas fa-chevron-down"></i></a>

												<ul id="currency_options">									
													<?php if(auth()->guard()->guest()): ?>
													<li><a href="<?php echo e(url("seller/register/step1")); ?>">Seller Register</a></li>
													<li><a href="<?php echo e(url("/login")); ?>">Seller Login</a></li>
													<?php endif; ?>										
												</ul>

												<?php
											}

											?>
										</li>
									</ul>
								</div>					
								<?php
							}
						}
						?>
						<?php if(auth()->guard()->guest()): ?>
						<div class="top_bar_menu">
							<ul class="standard_dropdown top_bar_dropdown">						
								<li>
									<?php
									if(Auth::check()){	
										if(Auth::user()->isSeller()){
											?>
											<a href="javascript:void(0)" id="selected_currency">Seller<i class="fas fa-chevron-down"></i></a>

											<ul id="currency_options">									
												<?php if(auth()->guard()->check()): ?>											
												<?php if(Auth::user()->isSeller()): ?>
												<li><a href="<?php echo e(url('/seller/dashboard')); ?>">Seller Dashboard</a></li>
												<li><a href="<?php echo e(url('/seller/dashboard/new_product')); ?>">Add New Product</a></li>
												<?php endif; ?>
												<?php endif; ?>

												<?php if(auth()->guard()->guest()): ?>
												<li><a href="<?php echo e(url("seller/register/step1")); ?>">Seller Register</a></li>
												<li><a href="<?php echo e(url("/login")); ?>">Seller Login</a></li>
												<?php endif; ?>										
											</ul>
											<?php
										}
									}
									else{
										?>
										<a href="javascript:void(0)" id="selected_currency">Seller<i class="fas fa-chevron-down"></i></a>

										<ul id="currency_options">									
											<?php if(auth()->guard()->guest()): ?>
											<li><a href="<?php echo e(url("seller/register/step1")); ?>">Seller Register</a></li>
											<li><a href="<?php echo e(url("/login")); ?>">Seller Login</a></li>
											<?php endif; ?>										
										</ul>

										<?php
									}

									?>
								</li>
							</ul>
						</div>					

						<?php endif; ?>
						<?php if(auth()->guard()->check()): ?>				
						<div class="top_bar_menu">
							<ul class="standard_dropdown top_bar_dropdown">			
								<li>
									<a href="javascript:void(0)" id=""><?php echo e(Auth::user()->username); ?><i class="fas fa-chevron-down"></i></a>
									<ul >
										<li><a href="#">My Profile</a></li>
										<hr>
										<li><a href="<?php echo e(url('cart')); ?>">My Cart</a></li>
										<li><a href="<?php echo e(url('wishlist')); ?>">My Wishlist</a></li>
										<?php if(Auth::user()->isCustomer() || Auth::user()->isSeller()): ?>
										<li><a href="<?php echo e(url('customer/my_wallet')); ?>">My Wallet : <label class="wallet_amount_with_currency_symbol">NA</label></a></li>
										
										<?php endif; ?>
										<?php if(Auth::user()->isSeller()): ?>
										<hr>
										<li><a href="<?php echo e(url('seller/dashboard')); ?>">Seller Dashboard</a></li>								
										<?php endif; ?>										
										<?php if(Auth::user()->isCustomer() || Auth::user()->isSeller()): ?>
										<hr>
										<li><a href="<?php echo e(url('customer')); ?>">Customer Dashboard</a></li>	
										<?php endif; ?>											
										<hr>
										<li><a href="<?php echo e(route('logout')); ?>"
											onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
											<?php echo e(__('Logout')); ?>

										</a>
										<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
											<?php echo csrf_field(); ?>
										</form></li>

									</ul>
								</li>
							</ul>
						</div>
						<?php else: ?>
						<div class="top_bar_user">							
							<div class="user_icon"><img src="<?php echo e(asset('one_tech/images/user.svg')); ?>" alt=""></div>
							<div><a href="<?php echo e(route('register')); ?>">Register</a></div>
							<div><a href="<?php echo e(url('login')); ?>">Login</a></div>		
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>		
	</div>

	<!-- Header Main -->

	<div class="header_main">
		<div class="container">
			<div class="row">

				<!-- Logo -->
				<div class="col-lg-2 col-sm-3 col-3 order-1">
					<div class="logo_container">
						<div class="logo"><a href="<?php echo e(url('/')); ?>"><?php echo e(config('app.name')); ?></a></div>
					</div>
				</div>

				<!-- Search -->
				<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
					<div class="header_search">
						<div class="header_search_content">
							<div class="header_search_form_container">
								<form action="<?php echo e(url('all_products')); ?>" method="get" class="header_search_form clearfix">
									<input type="search" required="required" id="keyword" name="keyword" class="header_search_input" placeholder="Search for products..." value="">
									<div class="custom_dropdown">
										<div class="custom_dropdown_list">
											<span class="custom_dropdown_placeholder clc">All Categories</span>
											<i class="fas fa-chevron-down"></i>
											<ul class="custom_list  clc" id="search_category_list">
												
											</ul>
										</div>
									</div>
									<button type="submit" class="header_search_button trans_300" value="Submit"><img src="<?php echo e(asset('one_tech/images/search.png')); ?>" alt=""></button>
								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- Wishlist -->
				<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
					<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
						<div class="wishlist d-flex flex-row align-items-center justify-content-end">
							<a href="<?php echo e(url('wishlist')); ?>">
								<div class="wishlist_icon"><img src="<?php echo e(asset('one_tech/images/heart.png')); ?>" alt=""></div>
							</a>
							<div class="wishlist_content">
								<div class="wishlist_text"><a href="<?php echo e(url('wishlist')); ?>">Wishlist</a></div>
								<div class="wishlist_count" id="wishlist_count"></div>
							</div>
						</div>

						<!-- Cart -->
						<div class="cart">
							<div class="cart_container d-flex flex-row align-items-center justify-content-end">
								<div class="cart_icon"> 
									<a href="<?php echo e(url('cart')); ?>">
										<img src="<?php echo e(asset('one_tech/images/cart.png')); ?>" alt="">
										<div class="cart_count"><span id="total_cart_items"></span></div>
									</a>
								</div>
								<div class="cart_content">
									<div class="cart_text"><a href="<?php echo e(url('cart')); ?>">Cart</a></div>
									<div class="cart_price" id="cart_price"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Main Navigation -->

	<nav class="main_nav">
		<div class="container">
			<div class="row">
				<div class="col">

					<div class="main_nav_content d-flex flex-row">

						<!-- Categories Menu -->

						<div class="cat_menu_container">
							<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
								<div class="cat_burger"><span></span><span></span><span></span></div>
								<div class="cat_menu_text">categories</div>
							</div>
							<form action="<?php echo e(url('all_products')); ?>" id="main_category_form">
								<ul class="cat_menu" id="nav_category_list">
									
								</ul>
							</form>
						</div>

						<!-- Main Nav Menu -->

						<div class="main_nav_menu ml-auto">
							<ul class="standard_dropdown main_nav_dropdown">
								<li><a href="<?php echo e(url('/')); ?>">Home<i class="fas fa-chevron-down"></i></a></li>
								<li><a href="<?php echo e(url('all_products')); ?>">All Products<i class="fas fa-chevron-down"></i></a></li>									
								<li class="hassubs">
									<a href="#">Pages<i class="fas fa-chevron-down"></i></a>
									<ul>
										<li><a href="<?php echo e(url('all_products')); ?>">All Products<i class="fas fa-chevron-down"></i></a></li>
										<li><a href="<?php echo e(url('cart')); ?>">Cart<i class="fas fa-chevron-down"></i></a></li>
										<li><a href="<?php echo e(url('wishlist')); ?>">Wishlist<i class="fas fa-chevron-down"></i></a></li>
										<li><a href="<?php echo e(url('contact')); ?>">Contact<i class="fas fa-chevron-down"></i></a></li>
									</ul>
								</li>
								<li><a href="<?php echo e(url('contact')); ?>">Contact<i class="fas fa-chevron-down"></i></a></li>
							</ul>
						</div>

						<!-- Menu Trigger -->

						<div class="menu_trigger_container ml-auto">
							<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
								<div class="menu_burger">
									<div class="menu_trigger_text">menu</div>
									<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</nav>

	<!-- Menu -->

	<div class="page_menu">
		<div class="container">
			<div class="row">
				<div class="col">

					<div class="page_menu_content">
						<div class="page_menu_search">
							<form action="<?php echo e(url('all_products')); ?>" method="get" id="page_search">
								<input type="search" required="required" class="page_menu_search_input" placeholder="Search for products..." name="keyword">
								<button type="submit" class="header_search_button trans_300" value="Submit"><img src="<?php echo e(asset('one_tech/images/search.png')); ?>" alt=""></button>
							</form>
						</div>
						<ul class="page_menu_nav">					
							
							<li class="page_menu_item">
								<a href="<?php echo e(url('/')); ?>">Home<i class="fa fa-angle-down"></i></a>
							</li>
							<li class="page_menu_item">
								<a href="<?php echo e(url('all_products')); ?>">All Products<i class="fa fa-angle-down"></i></a>
							</li>				
							<li class="page_menu_item"><a href="<?php echo e(url('contact')); ?>">Contact<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item"><a href="<?php echo e(url('cart')); ?>">Cart<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item"><a href="<?php echo e(url('wishlist')); ?>">Wishlist<i class="fa fa-angle-down"></i></a></li>
						</ul>

						<div class="menu_contact">
							<div class="menu_contact_item"><div class="menu_contact_icon"><img src="<?php echo e(asset('one_tech/images/phone_white.png')); ?>" alt=""></div>+977 9846055581</div>
							<div class="menu_contact_item"><div class="menu_contact_icon"><img src="<?php echo e(asset('one_tech/images/mail_white.png')); ?>" alt=""></div><a href="mailto:subash.niroula4455@gmail.com">subash.niroula4455@gmail.com</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</header>


<style type="text/css">
.wishlist_icon
{
	display: inline-block;
	width: 36px;
	height: 36px;
	background: #FFFFFF;
	box-shadow: 0px 1px 5px rgba(0,0,0,0.1);
	border-radius: 50%;
	text-align: center;
	cursor: pointer;
	margin-left: 36px;
	-webkit-transition: all 200ms ease;
	-moz-transition: all 200ms ease;
	-ms-transition: all 200ms ease;
	-o-transition: all 200ms ease;
	transition: all 200ms ease;
}
.wishlist_icon:hover
{
	box-shadow: 0px 1px 5px rgba(0,0,0,0.3);
}
.wishlist_icon i
{
	line-height: 36px;
	color: #cccccc;
}
</style>