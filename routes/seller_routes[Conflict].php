<?php
Route::group(['prefix' => 'seller','namespace'=>'Seller'], function() {
    //register the seller
	Route::group(['prefix' => 'register','namespace'=>'Register'], function() {
		Route::get('step1','Step1Controller@index');
		Route::post('create_account','Step1Controller@storeNewSellerAccount');
		Route::get('step1_completion','Step1CompletionController@index');
		Route::get('step2','Step2Controller@index');
		Route::post('step2','Step2Controller@store');

	});
	// dashboard of the seller
	Route::group(['prefix' => 'dashboard','namespace'=>'Dashboard','middleware'=>'seller'], function() {
		Route::get('','DashboardController@index');
		Route::group(['namespace' => 'Product'], function() {
			Route::get('new_product','NewProductController@index');			
			Route::post('new_product_store','NewProductController@store');
			Route::get('ordered_items', 'ProductOrdersController@index');
			Route::post('change_payment_product_status', 'ProductOrdersController@changeStatus');
			Route::get('my_products','MyProductController@index');
		});

		/*Route::get('new_product_store',function () {
			// return view("practical");
        $a = "<html><head><title>Store Page</title></head><body>My name is subash Niroula</body></html>";
        return ($a);
    });*/
		
});
});

?>