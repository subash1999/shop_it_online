<div class="col-lg-9">
	
	<!-- Shop Content -->

	<div class="shop_content">
		<div class="shop_bar clearfix">
			<div class="shop_product_count"><span>{{ count($results) }}  </span>products found
				@if ($old_filter['keyword']!=null && $old_filter['keyword']!="")
				&nbsp  &nbsp && Search Keyword : 
				<span><i>{{ $old_filter['keyword'] }}</i></span>
				@endif
				@if ($old_filter['category_names']!=null && $old_filter['category_names']!="")
				&nbsp  &nbsp  && Categories : 
				@foreach ($old_filter['category_names'] as $cate)
				<span><i> {{ $cate }}</i></span>
				@if (!$loop->last)
					,
				@endif
				@endforeach
				
				@endif
			</div>
			<div class="shop_sorting">
				<span>Sort by:</span>
				<ul>
					<li>
						<span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
						<ul>
							<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
							<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
							<li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>

		<div class="product_grid">
			<div class="product_grid_border"></div>

			@foreach ($results as $result)
			<!-- Product Item -->
			<div class="product_item {{ $result['is_new']? 'is_new':''}}">
				<a href="{{ url('product/'.$result['sp_id']) }}" tabindex="0">
					<div class="product_border"></div>
					<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ $result['photo'] }}" alt=""></div>
					<div class="product_content">
						<div class="product_price">{{ $curr_symb }} {{ $result['price'] }}</div>
						<div class="product_name" title="{{ $result['name'] }}"><div><a href="{{ url('product/'.$result['sp_id']) }}" tabindex="0">{{ $result['name'] }}</a></div></div>
					</div>
					{{-- <div class="product_fav"><i class="fas fa-heart"></i></div> --}}
					<ul class="product_marks">
						{{-- <li class="product_mark product_discount">-25%</li> --}}
						<li class="product_mark product_new">new</li>
					</ul>
				</a>
			</div>

			@endforeach		

		</div>

		<!-- Shop Page Navigation -->

		<div class="shop_page_nav d-flex flex-row">
			{{ $results->links() }}			
		</div>

	</div>

</div>