<?php 
namespace App\Http\Helpers;

use App\CategoryProductRelation;
use App\Currency;
use App\Http\Helpers\CurrencyHelper;
use App\Http\Helpers\UserHelper;
use App\SPPriceHistory;
use App\SellerProduct;

 use App\Category;

 class SPPriceHistoryHelper	
 {
 	public function getPriceOfSellerProduct($sp_id)
 	{
 		// price of the product
        $prices = SPPriceHistory::where('sp_id','=',$sp_id)->where('to_date','=',null)->orderBy('from_date','desc')->first();
        return round($prices->price,2);
    }
    public function getCurrentPriceObjectOfSellerProduct($sp_id)
    {
    	// price of the product
        return SPPriceHistory::where('sp_id','=',$sp_id)->where('to_date','=',null)->orderBy('from_date','desc')->first();
    }
    public function getCurrencyNameOfSellerProduct($sp_id)
    {
    	// price of the product
        $prices = SPPriceHistory::with('currency')->where('sp_id','=',$sp_id)->where('to_date','=',null)->orderBy('from_date','desc')->first();
        return $prices->currency->currency_name;

    }
     public function getCurrencySymbolOfSellerProduct($sp_id)
    {
    	// price of the product
        $prices = SPPriceHistory::with('currency')->where('sp_id','=',$sp_id)->where('to_date','=',null)->orderBy('from_date','desc')->first();
        $curr_helper = new CurrencyHelper;
        $curr_symbol = $curr_helper->getCurrencySymbol($prices->currency->curr_id);
        return $curr_symbol;

    }
    // gives the price in the current currency format
    public function getCurrentCurrencyPriceOfSellerProduct($sp_id)
    {
    	$user_helper = new UserHelper;
    	$to_curr_id = $user_helper-> getCurrentUserChoiceCurrencyId();
    	$price = $this->getPriceOfSellerProduct($sp_id);
    	$from_curr_id = $this->getCurrentPriceObjectOfSellerProduct($sp_id)->curr_id;
    	$currency_helper = new CurrencyHelper;
    	return $currency_helper->currencyConvert($from_curr_id,$to_curr_id,$price);
    }

 }