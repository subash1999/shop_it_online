
<?php 
Route::group(['namespace' => 'All_User','middleware'=>'not_admin'], function() {
	Route::group(['prefix' => 'product'], function() {
		Route::get('{sp_id}','ProductController@index')->name('single_product');
		// wishlist
		Route::post('is_spor_id_in_wishlist','ProductController@isSPOptionRelationInWishlist');
		Route::post('add_spor_in_wishlist','ProductController@addSPOptionRelationInWishlist');
		Route::post('remove_spor_in_wishlist','ProductController@removeSPOptionRelationInWishlist');
		Route::post('add_sp_in_wishlist','ProductController@addSellerProductInWishlist');
		Route::post('remove_sp_in_wishlist','ProductController@removeSellerProductInWishlist');
		// cart
		Route::post('add_sp_in_cart','ProductController@addSellerProductInCart');
		Route::post('add_spor_in_cart','ProductController@addSPOptionRelationInCart');
		// rating
		Route:: post('set_sp_rating','ProductController@setSPRatingOfUser');
		Route:: get('get_user_ratings/{sp_id}','ProductController@getUserRatings');
		// getting the category for the header
		Route::get('search/main_category_list','PublicHeaderController@getMainCategoryList');
	});
	Route::group(['prefix' => 'cart'], function() {
		Route::get('','CartController@index');
		Route::get('single_product_cart_values','CartController@getSingleProductCartValues');
		// change the quantity of the product in the cart
		// it can be both the seller product or the seller product option relation the function will decide what to do based if spor_id in the request is null
		Route::put('update_product_qty_in_cart','CartController@updateProductQtyInCart');
		Route::post('total_price_of_cart_with_currency_symbol', 'PublicHeaderController@totalPriceOfCartWithCurrencySymbol');	 
		Route::post('total_price_of_cart', 'CartController@getGrandTotalOfCart');	    
		Route::post('total_items_in_cart', 'PublicHeaderController@totalItemsInCart');
	    // same above two link in get method because i get 419 error on post ajax request on js_public_header.blade.php
	    // for the project final demo only it is a problem that should be solved
		Route::get('total_price_of_cart_with_currency_symbol', 'PublicHeaderController@totalPriceOfCartWithCurrencySymbol');
		Route::get('total_price_of_cart', 'CartController@getGrandTotalOfCart');	    
		Route::get('total_items_in_cart', 'PublicHeaderController@totalItemsInCart');

	});

	Route::group(['prefix' => 'wishlist'], function() {
		Route::get('','WishlistController@index');		
		Route::post('total_items_in_wishlist', 'PublicHeaderController@totalItemsInWishlist');
		Route::get('total_items_in_wishlist', 'PublicHeaderController@totalItemsInWishlist');
	});
	Route::group(['prefix' => 'checkout'], function() {
		Route::get('/', 'CheckoutController@index');
		Route::get('checkout_info','CheckoutInfoController@index');
		Route::post('buy_products','CheckoutInfoController@buyProducts');
		Route::get('buy_products_get_method','CheckoutInfoController@buyProductsGetMethod')->name('buy_products')->middleware('signed');
		Route::post('confirm_puarchase_by_email','CheckoutInfoController@confirmPuarchaseByEmail');
		Route::get('confirm_order', function ()
		{
			return view('public/pages/confirm_order_by_email');
		});
	});
	Route::group(['prefix' => 'wallet'], function() {
		Route::get('wallet_amount_with_currency_symbol','WalletController@getWalletAmountWithCurrencySymbol');
		Route::post('check_password_ajax','WalletController@checkPasswordAjax');
		Route::post('check_password','WalletController@checkPassword');

	});

	Route::group(['prefix' => 'currency'], function() {
		Route::post('selected_currency','PublicHeaderController@getSelectedCurrency');
		Route::post('currency_options','PublicHeaderController@getCurrencyOptions');
		Route::get('select_currency/{curr_id}','PublicHeaderController@selectCurrencyId');
	});
	Route::get('contact','ContactController@index');
	Route::post('send_contact_message','ContactController@sendMessage');
	Route::get('all_products','AllProductsController@index');

});
?>