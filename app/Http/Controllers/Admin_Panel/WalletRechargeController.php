<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Helpers\CurrencyHelper;
use App\Http\Helpers\UserHelper;
use App\WalletRecharge;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WalletRechargeController extends Controller
{
    public function index()
    {
    	$u_h = new UserHelper;
    	$c_h = new CurrencyHelper;
    	$curr_symb = $c_h->getCurrentCurrencySymbol();
    	$to = $u_h->getCurrentUserChoiceCurrencyId();
    	$rcs = WalletRecharge::latest()->get();
    	if($rcs==null){
    		$rcs = [];
    	}
    	foreach ($rcs as $rc) {
    		$from  = $rc->curr_id;
    		$amount = $rc->value;
    		$rc->value = $c_h->currencyConvert($from,$to,$amount);
    		$rc->curr_id = $to;
    		$rc->save();
    	}
    	$rcs = WalletRecharge::latest()->paginate(4);
    	$curr = Currency::all();
    	if($curr==null){
    		$curr = [];
    	}
    	return view('admin/sb_admin/admin_pages/wallet_recharge',compact('rcs','curr_symb','curr'));
    }
    public function storeRechargeCard(Request $request)
    {
    	$valid = $request->validate([
    		'value' => 'required|numeric|max:10000',
    		'curr_id' => 'required|integer|exists:currencies,curr_id',
    	]);
    	$code = bcrypt(Carbon::now()->toDateTimeString());
    	$rch = new WalletRecharge;
    	$rch->curr_id = $request->curr_id;
    	$rch->value = $request->value;
    	$rch->code = $code;
    	$rch->save();
    	return redirect()->back();
    }
}
