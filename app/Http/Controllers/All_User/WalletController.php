<?php

namespace App\Http\Controllers\All_User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CurrencyHelper;
use App\Http\Helpers\UserHelper;
use Auth;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
	
}
public function getWalletAmountWithCurrencySymbol()
{
	// currency_helper 
	$currency_helper = new CurrencyHelper;
	$currency_symbol =  $currency_helper->getCurrentCurrencySymbol(); 
	$u_h = new UserHelper;
	$current_curr_id = $u_h->getCurrentUserChoiceCurrencyId();
	$wallet = 0;
	if(Auth::check()){
		if(Auth::user()->getCurrentWallet()!=null){
			$wallet = Auth::user()->getCurrentWallet();
			if($wallet!=null){
				// dd($u_h->getCurrentUserChoiceCurrencyId());
				$wallet = $currency_helper->currencyConvert($wallet->curr_id,$current_curr_id,$wallet->amount);				
			}
		}
	}
	return $currency_symbol." ".$wallet;
}
 // for checking if the password entered matches the current users 
    public function checkPasswordAjax(Request $request)
    {
        if(!Auth::check()){
            return "0";
        }        
        return Auth::user()->checkPasswordAjax($request->password);
    }
     public function checkPassword(Request $request)
    {
        if(!Auth::check()){
            return false;
        }        
        return Auth::user()->checkPassword($request->password);;
    }
}