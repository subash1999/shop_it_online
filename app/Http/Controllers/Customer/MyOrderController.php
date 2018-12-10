<?php

namespace App\Http\Controllers\Customer;

use App\Bill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class MyOrderController extends Controller
{
    public function index()
    {
    	 $bills = Bill::with('user')->where('user_id',Auth::id())->latest()->paginate(3);
    	return view('customer/pages/my_orders',['bills'=>$bills]);
    }
}
