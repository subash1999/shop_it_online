<?php 
namespace App\Http\Helpers;

use App\CategoryProductRelation;
use App\Currency;
use App\Http\Helpers\CurrencyHelper;
use App\Http\Helpers\UserHelper;
use App\SellerProduct;
use Auth;
use App\Category;

 class CurrencyHelper	
 {
 	public function getCurrencySymbol($curr_id)
 	{
		$curr = Currency::find($curr_id);
		$symbol = $curr->symbol;
		if($symbol==null){
			$symbol = $curr->currency_name;
		}
		return $symbol;
 	}
 	/**
     * convert currency from one to another, pass from_curr_id , to_curr_id and amount and it will return the converted amount
     *
     * @param  integer  $curr_id, integer to_curr_id float $amount
     * @return float i.e the converted amount
     */
 	public function currencyConvert($from_curr_id,$to_curr_id,$amount)
 	{
 		$from_curr = Currency::find($from_curr_id);
 		$to_curr = Currency::find($to_curr_id);
 		$usd_amount = $amount/$from_curr->per_usd_value;
 		$to_amount = $usd_amount * $to_curr->per_usd_value;
 		return round($to_amount,2);
 	}

 	public function getCurrentCurrencySymbol()
 	{	
 		$currency = Currency::first();
 		$curr_id = $currency->curr_id;
 		$session_curr_id = $curr_id;
  		if(session('curr_id')!=null){
 			$curr_id = session('curr_id'); 			
 		}
 		else{
 			if(Auth::check()){
 				$user = Auth::user();
 		
 				if($user->curr_id!=null){
 					$curr_id = Auth::user()->curr_id;
 				} 				
 			}
 		}
 		$user_helper = new UserHelper;
 		$user_helper->setCurrentUserChoiceCurrencyId($curr_id);
 		$curr_id = $user_helper->getCurrentUserChoiceCurrencyId();
 		return $this->getCurrencySymbol($curr_id);

 	}
 }
 ?>