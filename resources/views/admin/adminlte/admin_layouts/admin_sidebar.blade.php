<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ asset('prof_pic.jpeg') }}" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
				<p>{{ $admin_name }}</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- search form -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search..."/>
				<span class="input-group-btn">
					<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</form>
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
			<li >
				<a href="#">
					<i class="fas fa-tachometer-alt"></i> <span>Dashboard</span> 
				</a>				
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fas fa-user"></i>
					<span>	Users</span>
					<i class="fa fa-angle-left pull-right"></i>					
				</a>
				<ul class="treeview-menu">
					<li><a  href="{{ url('adminlte/admin/users/all_users') }}"><i class="far fa-dot-circle"></i></i> All Users</a></li>
					<li><a id="users_admins" href=""><i class="far fa-dot-circle"></i></i> Admins</a></li>
					<li><a id="users_customers" href=""><i class="far fa-dot-circle"></i></i> Customers</a></li>
					<li><a id="users_sellers" href=""><i class="far fa-dot-circle"></i></i> Sellers</a></li>
					<li><a id="user_user_types" href=""><i class="far fa-dot-circle"></i></i> User Types</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fab fa-product-hunt"></i>
					<span>  Products</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="pages/charts/morris.html"><i class="far fa-dot-circle"></i></i> Product List</a></li>
					<li><a href="pages/charts/flot.html"><i class="far fa-dot-circle"></i></i> Seller Product List</a></li>
					<li><a href="pages/charts/inline.html"><i class="far fa-dot-circle"></i></i> Product Packages</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fas fa-truck"></i>
					<span> Shipments</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="pages/UI/general.html"><i class="far fa-dot-circle"></i></i>  Shipment Methods</a></li>
					<li><a href="pages/UI/icons.html"><i class="far fa-dot-circle"></i></i> Shipment States</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="far fa-money-bill-alt"></i>  <span>Payment</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="pages/forms/general.html"><i class="far fa-dot-circle"></i></i>Payment States</a></li>
					<li><a href="pages/forms/advanced.html"><i class="far fa-dot-circle"></i></i>Payment Method</a></li>
					<li><a href="pages/forms/editors.html"><i class="far fa-dot-circle"></i></i>Seller Payments</a></li>
				</ul>
			</li>
			<li>
				<a href="#">
					<i class="fas fa-tags"></i> <span>Categories</span>
				</a>
			</li>
			<li class="treeview">
				<a href="pages/calendar.html">
					<i class="fas fa-chart-line"></i> <span>Markets</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="pages/forms/general.html"><i class="far fa-dot-circle"></i></i>Retail Online</a></li>
					<li><a href="pages/forms/advanced.html"><i class="far fa-dot-circle"></i></i>Retail Offline</a></li>
					<li><a href="pages/forms/editors.html"><i class="far fa-dot-circle"></i></i>Wholesale Online</a></li>
					<li><a href="pages/forms/editors.html"><i class="far fa-dot-circle"></i></i>Wholesale Offline</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="pages/mailbox/mailbox.html">
					<i class="fas fa-handshake"></i> <span>Sales and Revenue</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="pages/forms/general.html"><i class="far fa-dot-circle"></i></i>Website Share On Categories</a></li>
					<li><a href="pages/forms/advanced.html"><i class="far fa-dot-circle"></i></i>Sales and Revenue</a></li>
					<li><a href="pages/forms/editors.html"><i class="far fa-dot-circle"></i></i>Sales History</a></li>
					<li><a href="pages/forms/editors.html"><i class="far fa-dot-circle"></i></i>Revenue History</a></li>
				</ul>
			</li>
			<li>
				<a href="pages/mailbox/mailbox.html">
					<i class="glyphicon glyphicon-inbox"></i> <span>Emails</span>
				</a>
			</li>
			<li>
				<a href="pages/mailbox/mailbox.html">
					<i class="fas fa-user-secret"></i> <span>Guests</span>
				</a>
			</li>
			<li>
				<a href="pages/mailbox/mailbox.html">
					<i class="fas fa-clock"></i> <span>Sessions</span>
				</a>
			</li>
			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>