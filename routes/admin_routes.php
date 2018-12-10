<?php

Route::group(array('prefix' => 'admin', 'namespace' => 'Admin_panel','middleware'=>'admin'), function()
{
    // admin panel routes
	Route::get('/', 'DashboardController@index')->name('admin_dashboard');
	//Sidebar
	//routes for the sidebar of the admin panel
	Route::group(array('prefix' => 'users', 'namespace' => 'Users'),function(){
		/*First the users sidebar with a single controller*/
		Route::group(array('prefix'=>'all_users'),function(){
			Route::get('/','AllUserController@index');
			Route::get('/get_table','AllUserController@getAllUsersTable');
			Route::delete('/{id}', 'AllUserController@destroy');
			
		});		
		Route::group(array('prefix'=>'deleted_users'),function(){
			Route::get('/','DeletedUserController@index');
			Route::get('/get_deleted_table','DeletedUserController@getDeletedUsersTable');
			Route::post('/restore_deleted_user_{id}','DeletedUserController@restoreDeletedUser');
		});
		Route::group(array('prefix'=>'add_admin'),function(){
			Route::resource('/','AddAdminController');
		});			
		Route::group(array('prefix'=>'user_types'),function(){
			Route::get('/', 'UserTypeController@index');
			Route::put('/{id}', 'UserTypeController@update');
			Route::delete('/{id}', 'UserTypeController@destroy');
			Route::get('/get_table','UserTypeController@getUserTypesTable');
			Route::post('/restore_deleted','UserTypeController@undoUserTypeDelete');
			Route::post('/', 'UserTypeController@store');
		});

		
	});
	Route::get('admin_mail','MailController@index');
	Route::post('send_mail','MailController@sendMail');
	Route::get('categories','CategoryController@index');
	Route::get('wallet_recharge','WalletRechargeController@index');
	Route::post('wallet_recharge/add_recharge','WalletRechargeController@storeRechargeCard');
	
	/*Route for updating the userType*/
	
});

// Route::get('admin/users/user_types','UsersController@updateUserType');

?> 
