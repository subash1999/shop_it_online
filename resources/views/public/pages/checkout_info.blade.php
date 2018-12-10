@extends('public/layout/public_layout')

@section('center_content')

<div class="container mt-5" id="input_black">
	<h2 class="h2 text-info">Final Step</h2>
	<style>
	/*for black font on input*/
	#input_black input{
		color:black;
	}
	#input_black select{
		color:black;
		display: inherit; 
		border: 1px solid #ced4da; 
		width: auto; 
		margin-left: auto; 
		-webkit-appearance: inline; 
		-moz-appearance: auto;
		border-bottom: auto; 
		color: black; 
		-webkit-transition: all .4s ease-in-out; 
		transition: all .4s ease-in-out; 
		
	}
</style>

<div >
	@php
		if(Auth::check()){
			$url = url('checkout/buy_products');			
		}
		else{
			$url = url('checkout/confirm_puarchase_by_email');
		}
	@endphp
	<form id="checkout_info_form" action="{{ $url }}" method="POST" required>
		@method('POST')
		@csrf
		{{-- first creating the hidden fields to include the items to checkout --}}
		@foreach ($items as $key=>$item)
		<input type="hidden" value="{{ $item['sp_id'] }}" name="items[{{ $key }}][sp_id]" >
		<input type="hidden" value="{{ $item['spor_id'] }}" name="items[{{ $key }}][spor_id]" >
		<input type="hidden" name="items[{{ $key }}][qty]" value="{{$item["qty"]}}">
		@endforeach
		<input type="hidden" value{{ Auth::id() }} name="user_id">
		{{-- hidden field to store the current currency_id --}}
		<input type="hidden" value="{{ $info['curr_id'] }}" name="curr_id">
		<div class="row">
			<div class="form-inline m-3">
				<label for="name" class="form-control-label m-3">Name</label>
				<input type="text" class="form-control" value="{{old('name',null) ? old('name',null) : $info['name'] }}" id="name" name="name">
			</div>
			<div class="form-inline m-3">
				<label for="email" class="form-control-label m-3">Email</label>
				<input type="email" class="form-control" value="{{old('email',null) ? old('email',null) : $info['email'] }}" id="email" name="email">
			</div>
			<div class="form-inline">
				<label for="phone" class="form-control-label m-3">Phone</label>
				<select name="country_code"  id="country_code"  class="form-control input-sm mr-3 no_width_change" >
					@include('reuseable_codes/select_country_calling_code_options')
				</select>
				<input type="phone" class="form-control" value="{{old('phone',null) ? old('phone',null) : $info['phone'] }}" id="phone" name="phone" placeholder="Phone number">				
			</div>
			@if ($errors->has('name')||$errors->has('phone') ||$errors->has('country_code') || $errors->has('email') )
			<div class="alert alert-danger m-3">
				<div class="alert-heading">Contact Information Error</div>
				<ul>
					@if ($errors->has('name'))
					<li>{{ $errors->first('name') }}</li>
					@endif
					@if ($errors->has('country_code'))
					<li>{{ $errors->first('country_code') }}</li>
					@endif
					@if ($errors->has('phone'))
					<li>{{ $errors->first('phone') }}</li>
					@endif
					@if ($errors->has('email'))
					<li>{{ $errors->first('email') }}</li>
					@endif
					<li></li>
				</ul>
			</div>
			@endif
			
		</div>
		
		
		<h4 class="h4 text-muted">Billing Address</h4>
		<div class="row">
			<div class="form-inline  m-3">
				<label for="bill_address" class="form-control-label  m-3">Address</label>
				<input type="text" class="form-control" value="{{ old('bill_address',null) ? old('bill_address',null) : $info['bill_address']}}" id="bill_address" name="bill_address">
			</div>
			<div class="form-inline m-3">
				<label for="bill_city" class="form-control-label m-3">City</label>
				<input type="text" class="form-control" value="{{ old('bill_city',null) ? old('bill_city',null) : $info['bill_city'] }}" id="bill_city" name="bill_city">
			</div>
			<div class="form-inline m-3">
				<label for="bill_country" class="form-control-label m-3">Country</label>
				<select name="bill_country"  id="bill_country"  class="form-control no_width_change" value="{{ old('bill_country',null) ? old('bill_country',null) : $info['bill_country'] }}">
					@include('reuseable_codes/select_country_options')
				</select>
				
			</div>
			@if ($errors->has('bill_address')||$errors->has('bill_country') || $errors->has('bill_city') )
			<div class="alert alert-danger">
				<div class="alert-heading">Contact Information Error</div>
				<ul>
					@if ($errors->has('bill_address'))
					<li>{{ $errors->first('bill_address') }}</li>
					@endif
					@if ($errors->has('bill_city'))
					<li>{{ $errors->first('bill_city') }}</li>
					@endif
					@if ($errors->has('bill_country'))
					<li>{{ $errors->first('bill_country') }}</li>
					@endif
					<li></li>
				</ul>
			</div>
			@endif
		</div>
		<label><label class="h4 text-muted">Shipping Address</label>&nbsp;&nbsp;&nbsp; 
		<button type="button" class="btn btn-secondary btn-sm mr-2" id="copy_billing_address">Copy Billing Address</button>
		<script>
			$('#copy_billing_address').click(function (){
				$('#ship_address').val($('#bill_address').val());
				$('#ship_city').val($('#bill_city').val());
				$('#ship_country').val($('#bill_country').val());
			});
		</script>
	</label>
	<div class="row">
		<div class="form-inline  m-3">
			<label for="address" class="form-control-label m-3">Address</label>
			<input type="text" class="form-control" value="{{ old('ship_address',null) ? old('ship_address',null) : $info['ship_address']}}" id="ship_address" name="ship_address">
		</div>
		<div class="form-inline m-3">
			<label for="city" class="form-control-label m-3">City</label>
			<input type="text" class="form-control" value="{{ old('ship_city',null) ? old('ship_city',null) : $info['ship_city'] }}" id="ship_city" name="ship_city">
		</div>
		<div class="form-inline m-3">
			<label for="country" class="form-control-label m-3">Country</label>
			<select name="ship_country" class="form-control no_width_change" id="ship_country" value="{{ old('ship_country',null) ? old('ship_country',null) : $info['ship_country'] }}">
				@include('reuseable_codes/select_country_options')
			</select>			
		</div>
		@if ($errors->has('ship_address')||$errors->has('ship_country') || $errors->has('ship_city') )
		<div class="alert alert-danger">
			<div class="alert-heading">Contact Information Error</div>
			<ul>
				@if ($errors->has('ship_address'))
				<li>{{ $errors->first('ship_address') }}</li>
				@endif
				@if ($errors->has('ship_city'))
				<li>{{ $errors->first('ship_city') }}</li>
				@endif
				@if ($errors->has('ship_country'))
				<li>{{ $errors->first('ship_country') }}</li>
				@endif
				<li></li>
			</ul>
		</div>
		@endif
	</div>
	
	<h4 class="h4 text-muted">Payment Option</h4>
	<div class="row">
		<div class="form-inlilne m-3">			
			<div>
				<img src="{{ asset('img/system/money_icon.png') }}" width="100" alt="" id="cash_on_delivery_icon" style="cursor: pointer;">
				<script>
					$(document).ready(function() {
						$("#cash_on_delivery_icon").click(function () {
							$('#cash_on_delivery').attr('checked',true);
							$('#wallet').attr('checked',false);
						});
					});
				</script>
				<div class="form-control" style="border: 0px;color: black;">
					<input type="radio" name="pay_method" value="Cash on Delivery" style="font-size: 20x;transform: scale(1.5);" checked  id="cash_on_delivery">&nbsp;
					@php
					$pay_method = "Cash On Delivery";
					@endphp
					@isset ( $info['cash_on_delivery_id'] )
					$pay_method = {{ $info['cash_on_delivery_id'] }};
					@endisset
				{{ $pay_method }}</div>
			</div>
		</div>
		<div class="form-group m-3">
			@auth				
			<img src="{{ asset('img/system/wallet.png') }}" width="100" alt="" id="wallet_icon" style="cursor: pointer;">
			<script>
				$(document).ready(function() {
					$("#wallet_icon").click(function () {
						$('#wallet').attr('checked',true);
						$('#cash_on_delivery').attr('checked',false);
					});
				});
			</script>
			@if($wallet_sufficient== true)
			<div class="form-control" style="border: 0px;color: black;">
				<input type="radio" name="pay_method" value="Wallet" style="font-size: 20x;transform: scale(1.5);" id="wallet">&nbsp;

			My Wallet</div>
			@else
			<label class="form-control">Not sufficient money in wallet</label>
			@endif

			@endauth
		</div>
	</div>
	<div class="form-items">
		<label for="country" class="form-control-label">Total Items :
			<label style="text-decoration: underline;">
				{{$info['total_items']}}
				<input type="hidden" value="{{ $info['total_items'] }}" name="total_items">
			</label>
		</label>			
	</div>
	<div class="form-inline">
		<label for="country" class="form-control-label">Total Price :
			<label style="text-decoration: underline;">
				{{ $info['currency_symbol'] }} {{$info['total_price']}}
				<input type="hidden" value="{{$info['total_price']}}" name="total_price">
			</label>
		</label>			
	</div>
	<input type="hidden" value="{{ $info['dc_id'] }}" name="dc_id" id="dc_id">
	@isset ($info['discount_coupons'])
	<div class="form-inline">		
		<label for="discount_coupons" class="form-control-label" style="font-size: large">Discount Value 
			<label style="text-decoration: underline;">
				{{ $info['currency_symbol'] }} {{$info['discount_value']}}
			</label>
		</label>
	</div>	
	@endisset
	<div class="form-inline">		
		<label for="payable_amount" class="form-control-label" style="font-size: large">Payable Amount : <label style="text-decoration: underline;">
			{{ $info['currency_symbol'] }} {{$info['total_price'] - $info['discount_value']}}
		</label>
		<input type="hidden" value="{{$info['total_price'] - $info['discount_value']}}" name="payable_amount" id="payable_amount">
		<br>
		
	</div>
	<div class="m-2"><label class="text-warning" style="font-size: small;">({{ $info['total_price_note'] }})</label>
	</label>			
</div>
@if ($errors->has('payable_amount')||$errors->has('total_price') || $errors->has('dc_id') || $errors->has('curr_id') )
<div class="alert alert-danger">
	<div class="alert-heading">Payment Error</div>
	<ul>
		@if ($errors->has('payable_amount'))
		<li>{{ $errors->first('payable_amount') }}</li>
		@endif
		@if ($errors->has('total_price'))
		<li>{{ $errors->first('total_price') }}</li>
		@endif
		@if ($errors->has('dc_id'))
		<li>{{ $errors->first('dc_id') }}</li>
		@endif
		@if ($errors->has('curr_id'))
		<li>{{ $errors->first('curr_id') }}</li>
		@endif
		<li></li>
	</ul>
</div>
@endif
<div class="row"><button type="button" class="btn btn-success btn-lg m-4" id="confirm_order_btn" >Confirm Order</button></div>
</form>
</div>

</div>

@endsection

{{-- Assets relating to this page --}}
@section('pagewise_assets')
{{-- cart custom js --}}
<script src="{{ asset('one_tech/js/product_custom.js') }}"></script>
{{-- cart custom css --}}
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/product_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('one_tech/styles/product_responsive.css') }}">

<script>
	$(document).ready(function() {
		var confirm_bootbox = null;
		var buying_bootbox = null;
		$('#confirm_order_btn').click(function (event) {
			event.preventDefault();
			title = " Confirm the puarches";
			message = `<h3>Payable Amount : {{ $info['currency_symbol'] }} ${$('#payable_amount').val()} </h3>`;
			message += `<h5>Payment Method Selected : ${$('input[name="pay_method"]:checked').val()}</h5>`;
			@auth
			message+=`<h6><Enter your password to confirm puarches/h6>

			<input class="form-control" id="password" name="password" type="password"></input>
			<label class="text-danger d-none" id="no_pw_match">Password does not matches</label>`;
			
			@endauth
			message+=`<br><label style="font-size:large;" class="text-warining">You are requested to remember the bill number generated to confirm the product delivery otherwise yo cannot receive ordered product</label>`;
			var ask_pass =true; 
			@guest
			ask_pass = false;
			@endguest
			confirm_bootbox = bootbox.confirm({
				title : title,	
				message : message,
				buttons: {
					confirm: {
						label: 'Confirm Puarches',
						className: 'btn-success'
					},
					cancel: {
						label: 'No',
						className: 'btn-danger btn-lg'
					}
				},
				callback : function (result) {
					if(result==true){
						if(ask_pass){
							confirmPuarches($('#password').val());
						}
						else{
							$("#checkout_info_form").submit();
						}
					}
				}
			});
		});
		function confirmPuarches(password) {
			var checking_password = bootbox.dialog({title:"Checking password", message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Checking Password...</div>' ,backdrop:true,});
			$.ajax({
				url: '{{ url('wallet/check_password_ajax') }}',
				type: 'POST',
				data: {password: password},
			})
			.done(function(result) {
				checking_password.modal('hide');
				if( result * 1){
					$("#no_pw_match").hide();
					$("#checkout_info_form").submit();
				}
				else{
					var dialog = bootbox.dialog({
						title: 'No Match',
						message: '<div class="text-danger h3">Password Didnot Matched</div>'
					});
					$("#no_pw_match").show();
				}
			})
			.fail(function() {
				checking_password.modal('hide');
				bootbox.dialog({title:"Error", message: '<div class="text-danger h3">Password Checking Failed due to ajax error</div>',closeButton:true ,backdrop:true,});			
				
			}).
			always(function(){
				checking_password.modal('hide');
			});		
			
		}

	});

</script>
@endsection