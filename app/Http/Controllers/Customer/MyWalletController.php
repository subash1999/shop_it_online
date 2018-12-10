<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Wallet;
use App\WalletRecharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyWalletController extends Controller
{
    public function index()
    {
    	$wallet = Wallet::where('user_id',Auth::id())->latest()->paginate(5);
    	$success="";
    	return view('customer/pages/my_wallet',compact('wallet','success'));
    }
    public function RechargeWallet(Request $request)
    {
    	$valid = $request->validate([
    		'code' => 'required|exists:wallet_recharges,code',
    	]);
    	$code = $request->code;
    	$rch = WalletRecharge::where('code',$code)->first();
    	$old_wallet = Wallet::where('user_id',Auth::id())->first();
    	$wallet = new Wallet;
    	$wallet->user_id = Auth::id();
    	$wallet->credit = $rch->value;
    	$wallet->debit = 0;
    	$wallet->amount = $old_wallet->amount+$rch->value;
    	$wallet->description = "Recharge By User";
    	$wallet->curr_id = $rch->curr_id;
    	$wallet->save();
    	$rch->forceDelete();
    	return redirect()->back()->with('success','Successful Recharge of '.$rch->value);
    }
}
