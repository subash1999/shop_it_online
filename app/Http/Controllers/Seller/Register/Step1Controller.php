<?php

namespace App\Http\Controllers\Seller\Register;

use App\Currency;
use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
use App\UserTypeRelation;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Step1Controller extends Controller
{
    public function index()
    {
    	return view('seller/seller_register/seller_register_pages/seller_register_step_1');
    }   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNewSellerAccount(Request $request)
    {
    	$validateData = $request->validate([
    		'username'=>'required|max:50|alpha_dash|unique:users,username',
    		'email'=>'required|max:50|email|unique:users,email',
    		'password'=>'confirmed|max:25'
    	]);    	
    	$username = $request->username;
    	$email = $request->email;
        // automatically hashes the password form user model
    	$password = $request->password;
    	
    	//creating the new user
    	$user = new User;
        $user->username = $username;
        $user->password = $password;
        $user->email = $email;
        $user->user_verify = null;
        if(!$user->save()){
            abort(403,'User not saved in seller register step 1');
        }
        //creating new user type relation
        $user_id = $user->user_id;
        $seller_user_type = UserType::where('type','=','seller')->first();
        $seller_user_type_id = $seller_user_type->ut_id;
        $user_type_relation = new UserTypeRelation;
        $user_type_relation->ut_id = $seller_user_type_id;
        $user_type_relation->user_id = $user_id;
        if(!$user_type_relation->save()){
            $user->forceDelete();
            abort(403,'User Type Relation not saved in seller register step 1');
        };
        $wallet = new Wallet;
        $wallet->user_id = $user->user_id;
        $wallet->credit = 0;
        $wallet->debit = 0;
        $wallet->amount = 0;
        $currency = Currency::first();
        $wallet->curr_id = $currency->curr_id;
        $wallet->description = "Creation of account";
        if(!$wallet->save()){
            $user->forceDelete();
            $user_type_relation->forceDelete();
            abort(403,'Wallet not saved in seller register step 1');
        };
        return redirect('seller/register/step1_completion')->with('user',$user);
        
    }
}
