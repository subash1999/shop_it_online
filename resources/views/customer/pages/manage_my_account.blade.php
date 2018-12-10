@extends('customer/layout/customer_layout')
@section('customer_center_content')
<div class="container-fluid"> 
	<div class="row">
		<div class="card bg-light mb-3 m-3" style="max-width: 18rem;">
			<div class="card-header">My Profile <button class="float-right" class=" btn btn-info">Edit</button></div>
			<div class="card-body">
				<h5 class="card-title">Name : {{ Auth::user()->getFullName() }}</h5>
				<p class="card-text">
					<ul type="none">
						<li>Gedner : {{ Auth::user()->getGender() }}</li>
						
					</ul></p>
				</div>
			</div>
			<div class="card bg-light mb-3 m-3" style="max-width: 18rem;">
				<div class="card-header">My Contact <button class="float-right" class=" btn btn-info">Edit</button></div>
				<div class="card-body">
					<h5 class="card-title">Username : {{ Auth::user()->username }}</h5>
					<p class="card-text">
						<ul type="none">
							<li>Email : {{ Auth::user()->email }}</li>
							<li>Phone : {{ Auth::user()->getPhone() }}</li>
							<li>Address : {{ Auth::user()->getAddress() }}</li>
							<li>City : {{ Auth::user()->getCity() }}</li>
							<li>Country : {{ Auth::user()->getCountry() }}</li>
						</ul></p>
					</div>
				</div>
			</div>
		</div>
		<!-- Discount Coupons -->
		<div class="row">
			<div ><h3 class="h3 text-muted text-center">Discount Coupons</h3>
			</div>
			<div class="cart_items" width="100%">
				<ul class="cart_list">
					@php
						// dd(Auth::user()->getDiscountCoupons());
					@endphp
					<table class="table table-bordered">
						@foreach ($dcs as $dc)
						<tr>
							<td
							><div class="cart_item_name cart_info_col">
								<div class="cart_item_title">Coupon Number </div>
								<div class="cart_item_text">{{ $dc->dc_id }}</div>
							</div>
						</td>
						<td>
							<div class="cart_item_quantity cart_info_col">
								<div class="cart_item_title">Valid From</div>
								<div class="cart_item_text">{{ $dc->from }}</div>
							</div>
						</td>
						<td>
							<div class="cart_item_price cart_info_col">
								<div class="cart_item_title">Valid To</div>
								<div class="cart_item_text">{{ $dc->to }}</div>
							</div>
						</td>

						<td>
							<div class="cart_item_total cart_info_col">
								<div class="cart_item_title">Amount</div>
								<div class="cart_item_text">{{ Auth::user()->getCurrentCurrencySymbol() }} {{ Auth::user()->getDCAmountInCurrenctCurrency($dc->dc_id) }}</div>
							</div>
						</td>
						<td>
							<div class="cart_item_total cart_info_col">
								<div class="cart_item_title">Discount Code</div>
								<div class="cart_item_text">{{ $dc->coupon_code }}</div>
							</div>
						</td>
					</tr>						

					<hr>
					@endforeach
				</table>
				<div>
					{{ $dcs->links() }}
				</div>

			</ul>
		</div>
	</div>
	<hr>

	@endsection
	@section('customer_pagewise_assets')

	@endsection