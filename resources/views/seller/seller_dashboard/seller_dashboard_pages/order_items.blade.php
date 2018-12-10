{{--  --}}
@extends('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_layout')
@section('center_content')
{{-- expr --}}

<div class="" style="margin: 10px; padding: 10px; width:100%">
	<div class="">

		<div class="row">
			<div class="h1" align="center">Products Orderd <label class="text-danger">(Only one save at a time)</label></div>
			<hr>
			<table class="table">
				@foreach ($bills as $bill)	
				<tr>
					<form action="{{ url('seller/dashboard/change_payment_product_status') }}" method="post">
						@csrf
						@method('post')
						<td>
							<div class="cart_item_title"><u>Bill Number (Id) </u></div>
							<div class="cart_item_text">{{ $bill->bill_id }}</div>
						</td>
						<td>
							<div class="cart_item_title"><u>Name</u></div>
							<div class="cart_item_text">{{ $bill->name }}</div>
						</td>
						<td>
							<div class="cart_item_title"><u>Billing Address</u></div>
							<div class="cart_item_text">{{ $bill->bill_address.','.$bill->bill_city.','.$bill->bill_country }}</div>
							<div class="cart_item_text"><u>Phone : </u>{{ $bill->phone1 }}</div>
						</td>
						<td>
							<div class="cart_item_title"><u>Shipping Address</u></div>
							<div class="cart_item_text">{{ $bill->ship_address.','.$bill->ship_city.','.$bill->bill_country }}</div>
							<div class="cart_item_text"><u>Shipment Status :</u> 
								<select name="product_status" class="form-control">
									@php
									$confirmed = false;
									$to_be= false;
									$delivered = false;
									$canceled = false;
									if (strcasecmp($bill->product_status,'Confirmed')==0){
										$confirmed = true;
									}	
									else if(strcasecmp($bill->product_status,'To be Confirmed')==0){
										$to_be = true;
									}
									else if(strcasecmp($bill->product_status,'Canceled')==0){
										$canceled = true;
									}
									else{
										$delivered = true;
									}						
									@endphp
									<option value="Delivered" {{ $delivered ? 'selected' : '' }}>Delivered
									</option>
									<option value="To be Confirmed" {{ $to_be ? 'selected' : '' }}">To be Confirmed</option>
									<option value="Confirmed" {{ $confirmed ? 'selected' : '' }}>Confirmed</option>
									<option value="Canceled" {{ $canceled ? 'selected' : '' }}>Canceled</option>
								</select>
							</div>
						</td>
						<td>
							<div class="cart_item_title"><u>Total Amount</u></div>
							<div class="cart_item_text">{{ Auth::user()->getCurrentCurrencySymbol() }} {{ $bill->getTotalAmountInCurrentCurrency() }}</div>
						</td>
						<td>
							<div class="cart_item_title"><u>Discount Amount</u></div>
							<div class="cart_item_text">{{ Auth::user()->getCurrentCurrencySymbol() }} {{ $bill->getDiscountAmountInCurrentCurrency() }}</div>
						</td>
						<td>
							<div class="cart_item_title"><u>Final Amount</u></div>
							<div class="cart_item_text">{{ Auth::user()->getCurrentCurrencySymbol() }} {{ $bill->getFinalAmountInCurrentCurrency() }}</div>	
							<div class="cart_item_text"><u>Bill Payment Status :</u>
								<select name="payment_status" class="form-control">
									@php
									$pending = false;
									$paid = false;
									if (strcasecmp($bill->payment_status,'paid')==0){
										$paid = true;
									}	
									else{
										$pending = true;
									}
									@endphp
									<option value="paid" {{ $paid ? 'selected' : '' }}">Pending</option>
									<option value="pending" {{ $pending ? 'selected' : '' }}>Paid</option>

								</select>

							</div>			
						</td>
						<td>
							<div class="cart_item_title"><u>Save Changes</u></div>
							<div>
								<input type="hiddden" style="display:none;" id="" name="bill_id" value="{{ $bill->bill_id }}">
								<input type="submit" value="Save Changes" class="btn btn-warning"></div>			
							</td>
						</form>
					</tr>
					@endforeach	
				</table>
				<div>
					{{ $bills->links() }}
				</div>
			</div>
		</div>
	</div>

	@endsection