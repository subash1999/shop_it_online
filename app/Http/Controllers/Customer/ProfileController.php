<?php

namespace App\Http\Controllers\Customer;

use App\Bill;
use App\Customer;
use App\DiscountCoupon;
use App\Http\Controllers\Controller;
use App\Seller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','verified']);
    }
    /**
     * Show the profile page of the user
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dcs =DiscountCoupon::where('user_id',Auth::id())->orderBy('to','DESC')->paginate(3);
        $bills = Bill::where('user_id',Auth::id())->latest()->paginate(3);
    	return view('customer/pages/manage_my_account',['dcs'=>$dcs,'bills'=>$bills]);

    }
    function changePP(Request $request)
    {
        dd($request->all());
        if(!Auth::check()){
            return "0";
        }
        $user_id = Auth::id();
    	$user = User::find($user_id);
    	if($user==null){
    		return "0";
    	}
    	if($user->isAdmin()){
    		return "0";
    	}
    	$photo_input = $request->pp_input;
    	$photo_name = "Profile_photo_"."SessionID_".session()->getId()."_".microtime().".".$photo_input->getClientOriginalExtension();

        //file storage disk configuration can be found in config/filesystems.php
        //storing the photo name in the public disk         
    	Storage::disk('public_uploads')->put($photo_name,File::get($photo_input));
    	$ret = "0";
    	if($user->isSeller()){
    		$s = Seller::where('user_id',$user_id)->first();
    		$s->photo = $photo_name;
    		$s->save();
    	}
    	else if($user->isCustomer()){    		
    		$c = Customer::where('user_id',$user_id)->first();
    		$c->photo = $photo_name;
    		$c->save();
    	}
    }

    public function editProfile()
    {
        
    }
}
