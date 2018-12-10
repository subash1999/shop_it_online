	@extends('customer/layout/customer_layout')
	@section('customer_center_content')
	<div class="cart-items">
		<!-- Now the bills -->
		<div class=""></div>
		<div ><h3 class="h3 text-muted text-center">My Order's Bills</h3>
			<div  class="cart_items">
				<ul class="cart-list" >
					@foreach ($bills as $bill)	
					<div class="cart_item clearfix">
						
						<div class="cart_item_image h4"> 

							<div class="cart_item_title">Bill Number (Id) : <h3>{{ $bill->bill_id }}</h3> </div>								

						</div>
						<div class="cart_info_col">
							<div class="cart_item_title">Name</div>
							<div class="cart_item_text">{{ $bill->name }}</div>
						</div>
						<div class="cart_info_col">
							<div class="cart_item_title">Billing Address</div>
							<div class="cart_item_text">{{ $bill->bill_address.','.$bill->bill_city.','.$bill->bill_country }}</div>
							<div class="cart_item_text">Phone : {{ $bill->phone1 }}</div>
						</div>
						<div class="cart_info_col">
							<div class="cart_item_title">Shipping Address</div>
							<div class="cart_item_text">{{ $bill->ship_address.','.$bill->ship_city.','.$bill->bill_country }}</div>
							<div class="cart_item_text">Shipment Status : {{ $bill->product_status }}</div>
						</div>
						<div class="cart_info_col">
							<div class="cart_item_title">Total Amount</div>
							<div class="cart_item_text">{{ Auth::user()->getCurrentCurrencySymbol() }}  {{ $bill->getTotalAmountInCurrentCurrency() }}</div>
						</div>
						<div class="cart_info_col">
							<div class="cart_item_title">Discount Amount</div>
							<div class="cart_item_text">{{ Auth::user()->getCurrentCurrencySymbol() }} {{ $bill->getDiscountAmountInCurrentCurrency() }}</div>
						</div>
						<div class="cart_info_col">
							<div class="cart_item_title">Final Amount</div>
							<div class="cart_item_text">{{ Auth::user()->getCurrentCurrencySymbol() }}  {{ $bill->getFinalAmountInCurrentCurrency() }}</div>	
							<div class="cart_item_text">Bill Payment Status :{{ $bill->payment_status }}</div>			
						</div>
						<div class="cart_info_col">
							<div class="cart_item_title"><h6 class="h6">Action</h6></div>
							<div >
								<form action="{{ url('customer/bill') }}" method="get" target="_blank" rel="noopener noreferrer">
									<input type="hidden" name="bill_id" value="{{ $bill->bill_id }}">
									<input type="hidden" name="email" value="{{ $bill->email }}">
									<input type="submit" class="btn btn-link" target="_blank" rel="noopener noreferrer" value="View Bill">
								</form>							
								<br>
								<button type="button" class="btn  btn-info" id="send_email_btn_{{ $loop->iteration }}">Send Bill To My Mail</button>
								<script>
									$(document).ready(function() {
										$('#send_email_btn_{{ $loop->iteration }}').click(function (){
											confirm_bootbox = bootbox.confirm({
												title : "Confirm Bill Sending",	
												message : "Please click 'Yes' to confirm the bill sending",
												buttons: {
													confirm: {
														label: 'Yes',
														className: 'btn-success'
													},
													cancel: {
														label: 'No',
														className: 'btn-danger btn-lg'
													}
												},
												callback : function (result) {

													if(result==true){
														var loading_box = bootbox.dialog({
															title : 'Please Wait',
															message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i>Sending Mail...</div>',
															onEscape: true,
															show : true,
															backdrop : true,
															closeButton: true,
															animate : true,
															 });
														$.ajax({
															url: '{{ url('customer/email_bill') }}',
															type: 'POST',
															data: {
																bill_id: '{{ $bill->bill_id }}',
																email : '{{ $bill->email }}'
															},
														})
														.done(function() {
															bootbox.alert({
																title : "<h4 class='text-success'>Bill Sent</h4>",
																message : "The bill was sent to your mail",
															});
														})
														.fail(function() {
															bootbox.alert({
																title : "<h4 class='text-danger'>Bill Sending Failed</h4>",
																message : "The bill was not sent to your mail due to Ajax error",
															});
														})
														.always(function() {
															loading_box.modal('hide');
														});
													}
												}
											});


										});
									});
								</script>
							</div>
						</div>
						
					</div>
					@endforeach	
				</ul>
			</div>
			<div>
				{{ $bills->links() }}
			</div>
		</div>
		@endsection