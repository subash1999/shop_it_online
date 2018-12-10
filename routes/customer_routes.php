<?php
Route::group(['prefix' => 'customer','namespace'=>'Customer'], function() {
	// for teh customer also go to the profile page
	Route::get('/', 'ProfileController@index');
	Route::group(['prefix' => 'profile'], function() {
		Route::get('/', 'ProfileController@index');
		Route::post('change_pp','ProfileController@changePP');
		Route::get('my_orders', 'MyOrderController@index');

	});
	Route::get('my_wallet', 'MyWalletController@index');
	Route::post('recharge_wallet','MyWalletController@RechargeWallet');
	// Routes for the bill
	// the bill route is post because i want to make sure only the authorized one can view the bill through the post request
	Route::get('bill','BillController@index');
	Route::post('email_bill','BillController@sendBillByEmail');
	
});
