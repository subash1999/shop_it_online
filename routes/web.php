<?php
use App\Bill;
use App\User;
use Carbon\carbon;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// use Auth;

// Route::get('/', function () {
// 	// $users = User::ofType('seller')->get();

// 	// return ($users);
// 	// return view('button');
// 	return view('welcome');
// });
// Route::get('initial_page', function() {
// 	return view('initial_page');
// });
// $user = new User;
// $user->username = "a";
// $user->password = bcrypt("a");
// $user->email = "a@gmail.com";
// $user->save();
Auth::logout();
Route::get('practice', function() {
	return view('practice');
});
Route::get('practice_controller', 'PracticeController@index');
Route::get('test',function(){
	$user_helper = new App\Http\Helpers\UserHelper;
	return $user_helper->isUserAdmin(1);
});
Route::get('init',function(){
	// return view('welcome');
	
	return view('initial_page');
});
Route::get('','HomeController@index')->middleware('not_admin');
// Auth::loginUsingId(2);
// Auth::logout();
Auth::routes(['verify' => true]);

// (admin_panel)requiring the routes for the admin panel
require ('admin_routes.php');
// (seller)routes for the seller related activities 
require ('seller_routes.php');
// pages for all kind of the users including guest can enter
// it include the home page,products, cart,etc
require ('all_user_routes.php');
// pages for the customer 
// basically the customer dashboard stuff i.e updating customer info
require ('customer_routes.php');

Auth::routes();

