
<div class="col-lg-3">

	<!-- Shop Sidebar -->
	<div class="shop_sidebar">
		<form action="{{ url('all_products') }}" method="get">
			@method('get')
			
			<div class="sidebar_section filter_by_section">
				<div class="sidebar_title">Filter By</div>
				@if ($selected_seller!=null)
				<div class="sidebar_subtitle">
					<img src="{{ asset('one_tech/images/search.png') }}" style="background-color: orange;" alt="" class="mr-2">
					<input type="text" placeholder="Search in the Shop" style="border:0px;border-bottom: bold;" name="shop_keyword" value={{ $old_filter['shop_keyword'] }}>
				</div>		
				@endif				
				<div class="sidebar_subtitle">Categories</div>
				<ul class="sidebar_categories text-muted" >
					@foreach ($cate_list as $key => $cate)
					<li><div class="form-inline"> <input style="transform: scale(1.3);" type="checkbox" value="{{ $cate['cate_id'] }}" id="cate_{{ $cate['cate_id'] }}" name="category[{{ $key }}]" class="form-control m-2 cate_input" >{{ $cate['cate_name'] }}</div></li>
					@endforeach				
				</ul>
				<div class="sidebar_subtitle">Price ({{ $curr_symb }})</div>
				<div class="filter_price">
					<div><div class="form-inline m-3"><label for="min" class="form-control-label">Min : </label><input type="number" step="0.001" class="form-control" name="min" id="min" value="{{ $old_filter['min'] }}"></div>
					<div class="form-inline m-3"><label for="max" class="form-control-label">Max : </label><input type="number" step="0.001" class="form-control" name="max" id="max" value="{{ $old_filter['max'] }}"></div>
				</div>				
			</div>
			<div class="sidebar_subtitle">Sellers</div>
			<div class="form-group">
				<select name="seller_id" id="seller_id" class="form-control bootstrap-select m-3 not_width_change">
					<option value="" selected>-- Select Seller --</option>
					@foreach ($sellers as $seller)
					<option value="{{ $seller->seller_id }}">{{ $seller->company_name }}</option>
					@endforeach
				</select>
				@if ($selected_seller!=null)
				<script>
					$(document).ready(function() {
						$("#seller_id").val({{ $selected_seller->seller_id }});
					});
				</script>
				@endif
				@if ($old_filter['category']!=null)
				@foreach ($old_filter['category'] as $cate_id)
				<script>
					$(document).ready(function() {
						$('#cate_{{ $cate_id }}').prop('checked',true);
					});
				</script>
				@endforeach
				@endif
				
				<style>
				.bootstrap_select{
					color:black;
					display: inherit; 
					border: 1px solid #ced4da; 
					/*width: auto; */
					margin-left: auto; 
					-webkit-appearance: inline; 
					-moz-appearance: button;
					border-bottom: auto; 
					color: black; 
					-webkit-transition: all .4s ease-in-out; 
					transition: all .4s ease-in-out; 

				}
			</style>
		</div>
	</div>
	<div class="sidebar_section">
		<div class="sidebar_title"><input type="submit" class="btn btn-lg btn-info m-3" value="Apply Filter"></div>
		<div></div>
	</div>
</form>		

</div>

</div>
