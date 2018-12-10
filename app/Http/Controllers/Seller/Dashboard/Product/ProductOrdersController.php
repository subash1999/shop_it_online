<?php

namespace App\Http\Controllers\Seller\Dashboard\Product;

use App\Bill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ProductOrdersController extends Controller

{
	// Route::get('ordered_items', 'ProductOrdersController@index');
	// Route::post('change_payment_product_status', 'ProductOrdersController@changeStatus');
    public function index()
    {
    	$bills = Bill::where('user_id',Auth::id())->latest()->paginate(6);
    	return view('seller/seller_dashboard/seller_dashboard_pages/order_items',['bills'=>$bills]);
    }
    public function changeStatus(Request $request)
    {
    	$bill = Bill::find($request->bill_id);
    	if($bill==null){
    		abort(404,'Bill Not Found to modify');
    	}
    	$bill->payment_status = $request->payment_status;
    	$bill->product_status = $request->product_status;
    	$bill->save();
    	
    	return redirect()->back();
    	
    }

}
