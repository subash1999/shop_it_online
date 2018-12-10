

<script>
	
	function getCartTotalNumberOfItems() {
		$.ajax({
			url: '<?php echo e(url('cart/total_items_in_cart')); ?>',
			type: 'GET',	
			data : null,

		})
		.done(function(result) {
			result =  $.trim(result);
			// anyelement with the class total cart items will also be updated of the total result
			$(".total_cart_items").text(result);
			if(result<=0){
				$(".cart_count").hide();
			}
			$(".cart_count").show();
			if(result>99){
				result = "99+";
			}
			$("#total_cart_items").text(result);
		})
		.fail(function(error, textStatus) {
			$("#total_cart_items").text("NA");
			console.log("error total cart items");
			console.log(error);
		})			

	}
	function getCartTotalPrice() {
		$.ajax({
			url: '<?php echo e(url('cart/total_price_of_cart_with_currency_symbol')); ?>',
			type: 'GET',	
			data : null,				
		})
		.done(function(result) {
			result =  $.trim(result);			
			var total = result ;
			if(result.length>11){
				result = result.substring(0, 11) + "...";
			}
			$("#cart_price").html(`<label title="${total}">${result}</label>`);
		})
		.fail(function(error,textStatus) {
			$("#cart_price").text("NA");
			console.log("error cart total price");
			console.log(error);
		})			

	}
	function getWishlistTotalNumberOfItems() {
		$.ajax({
			url: '<?php echo e(url('wishlist/total_items_in_wishlist')); ?>',
			type: 'GET',	
			data : null,

		})
		.done(function(result) {
			result =  $.trim(result);			
			$(".total_wishlist_items").text(result);
			if(result>99){
				result = "99+";
			}
			$("#wishlist_count").html(`<label title="${result}">${result}</label>`);
		})
		.fail(function(error, textStatus) {
			$("#wishlist_count").text("NA");
			console.log("error wishlist count");
			console.log(error);
		})			

	}
	// for header wallet
	function getWalletAmountWithCurrencySymbol() {
		$.ajax({
			url: '<?php echo e(url('wallet/wallet_amount_with_currency_symbol')); ?>',
			type: 'GET',	
			data : null,

		})
		.done(function(result) {
			result =  $.trim(result);
			var total = result ;
			if(result.length>11){
				result = result.substring(0, 11) + "...";
			}
			$(".wallet_amount_with_currency_symbol").html(`<label title="${total}">${result}</label>`);	
		})
		.fail(function(error, textStatus) {
			$("#wishlist_count").text("NA");
			console.log("error wishlist count");
			console.log(error);
		})			
	}
	function refreshWishlistAndCart() {
		getCartTotalNumberOfItems();
		getCartTotalPrice();
		getWishlistTotalNumberOfItems();	
			getWalletAmountWithCurrencySymbol();
		
	}

	refreshWishlistAndCart();
</script>


<script type="text/javascript">
	$(document).ready(function() {
		function selectedCurrency() {
			$.ajax({
				url: '<?php echo e(url('currency/selected_currency')); ?>',
				type: 'POST',	
				data : null,

			})
			.done(function(result) {
				$("#selected_currency").text(result);
			})
			.fail(function(error, textStatus) {
				$("#selected_currency").text("NA");
				console.log("error selected Currency");
				console.log(error);
			});	

		}
		function currencyOptions() {
			$.ajax({
				url: '<?php echo e(url('currency/currency_options')); ?>',
				type: 'POST',	
				data : null,

			})
			.done(function(options) {
				options = $.parseJSON(options);
				var html_opt = "";
				for (var i = 0; i < options.length; i++) {
					var href_url = "<?php echo e(url('currency/select_currency')); ?>" +"/"+ options[i]["curr_id"];
					html_opt+=`<li><a href="${href_url}">${options[i]["option_name"]}</a></li>`;
				}				
				$(".currency_options").html(html_opt);
				// re initalizing the html variable
				html_opt = "";
				for (var i = 0; i < options.length; i++) {
					var href_url = "<?php echo e(url('currency/select_currency')); ?>" +"/"+ options[i]["curr_id"];
					html_opt+=`<li><a href="${href_url}">${options[i]["option_name"]}<i class="fa fa-angle-down"></i></a></li>`;
				}
				$(".page_menu_currency_options").html(html_opt);

			})
			.fail(function(error, textStatus) {
				// $(".currency_options").text("NA");
				console.log("error  Currency options");
				console.log(error);
			});	

		}
		function currency() {
			selectedCurrency();
			currencyOptions();
		}
		currency();
	});
</script>


<script type="text/javascript">
	function clickMainSearchCategory($cate_id=null) {
		if($cate_id==null){
			$("#category").val("");
		}
		else{
			$("#category").val($cate_id);
		}
	}
	function clickMainCategoryOpen($cate_id=null) {
		if($cate_id==null){
			$("#main_category").val("");
		}
		else{
			$("#main_category").val($cate_id);
			$("#main_category_form").submit();
		}
	}
	// $(document).ready(function() {
		function getMainSearchCategory() {
			$.ajax({
				url: '<?php echo e(url('product/search/main_category_list')); ?>',
				type: 'GET',
			})
			.done(function(category_list) {
				if(category_list!=null){
					var html = `<input type="hidden" value="" id="category" name="category[0]">`;
					html += `<li onClick="clickMainSearchCategory()"><a class='clc' href='javascript::void(0)'>All Categories</a></li>`;
					for (var i = 0; i < category_list.length; i++) {
						html +=  `<li onClick="clickMainSearchCategory(${category_list[i]["cate_id"]})"><a class='clc' href='javascript::void(0)'>${category_list[i]["cate_name"]}</a></li>`;
					}
					$("#search_category_list").html(html);
				}
				// for the category in the navigation shown while in the full page
				if(category_list!=null){
					var html = `<input type="hidden" value="" id="main_category" name="category[]">`;
					for (var i = 0; i < category_list.length; i++) {
						html +=  `<li onClick="clickMainCategoryOpen(${category_list[i]["cate_id"]})"><a href='<?php echo e(url('all_products/?category%5B%5D=')); ?>${category_list[i]["cate_id"]}' >${category_list[i]["cate_name"]}<i class="fas fa-chevron-right ml-auto"></i></a></li>`;
						
					}
					$("#nav_category_list").html(html);
					
				}
				// when the page width is decreased the page menu is displayed the category for it is
			})
			.fail(function(error) {
			// $(".currency_options").text("NA");
			console.log("error fail in getting main category list for the search");
			console.log(error);
		})
		}
		getMainSearchCategory();
		
	// });
</script>