@if ($selected_seller!=null)
<div class="home mb-5">
	<div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ url('one_tech/images/shop_background.jpg') }}"></div>
	<div class="home_overlay"></div>
	<div class="home_content d-flex flex-column align-items-center justify-content-center">
		<h2 class="home_title">{{ $selected_seller->company_name }}</h2>
	</div>
	
</div>
@endif
