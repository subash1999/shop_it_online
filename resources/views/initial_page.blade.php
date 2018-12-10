@extends('layouts/app')
@section('content')
<div class="m-5">
	
	<br>
	<h3>Customer : All the major links related to the customer are here</h3>
	<div class="admin">
		<ol><h3>Product</h3>
			<li><a href="{{ url('customer') }}"><h4>Customer main page(Dashoard)</h4></a></li><br>
			{{-- <li><a href="{{ url('product/19') }}"><h4>Product Without option (No Options)</h4></a></li><br> --}}
			{{-- <li><a href="{{ url('cart') }}"><h4>Shopping Cart</h4></a></li><br> --}}

		</ol>

	</div>	
	<hr>
	<h3>SELLER : All the major links related to the seller are here</h3>
	<div class="seller">	
		<ol><h3>Seller Registration</h3>
			<li><a href="{{ url('seller/register/step1') }}"><h4>Seller Register : Step 1 (user registration only)</h4></a></li>
			<li><a href="{{ url('seller/register/step1_completion') }}"><h4>Seller Register : Step 1_completion (user registration completion )</h4></a></li><br>
			<li><a href="{{ url('seller/register/step2') }}"><h4>Seller Register : Step 2 (full info of the seller )</h4></a></li><br>
		</ol>
		<ol><h3>Seller Dashboard</h3>
			<li><a href="{{ url('seller/dashboard/new_product') }}"><h4>New Product</h4></a></li>
			<li><a href="{{ url('seller/dashboard') }}"><h4>Seller dASHBOARD (Not Done)</h4></a></li><br>			
		</ol>

		<br>
	</div>
	<hr>
	<br>
	<h3>Admin : All the major links related to the Admin are here</h3>
	<div class="admin">
		<ol><h3>Dashboard</h3>
			<li><a href="{{ url('admin') }}"><h4>Admin Main Dashboard (Not Done)</h4></a></li>
			<li><a href="{{ url('admin/users/all_users') }}"><h4>All Users</h4></a></li><br>
			<li><a href="{{ url('admin/users/deleted_users') }}"><h4>Deleted Users</h4></a></li><br>
			<li><a href="{{ url('admin/users/add_admin') }}"><h4>Add admin form</h4></a></li><br>
			<li><a href="{{ url('admin/users/user_types') }}"><h4>User Types</h4></a></li><br>
		</ol>

	</div>	
	<br>
	<hr>
	<h3>Public : All the major links related to the public are here</h3>
	<div class="admin">
		<ol><h3>Product</h3>
			<li><a href="{{ url('product/18') }}"><h4>Product with options</h4></a></li><br>
			<li><a href="{{ url('product/19') }}"><h4>Product Without option (No Options)</h4></a></li><br>
			<li><a href="{{ url('cart') }}"><h4>Shopping Cart</h4></a></li><br>

		</ol>

	</div>	
</div>

@endsection