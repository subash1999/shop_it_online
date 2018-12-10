<?php 
namespace App\Http\Helpers;

use App\CategoryProductRelation;
use App\Currency;
use App\Http\Helpers\CurrencyHelper;
use App\Http\Helpers\UserHelper;
use App\SellerProduct;
use Auth;
use App\Category;

class SessionHelper	
{
	public function setCurrencyId($curr_id=null)
	{
		session(['curr_id'=>$curr_id]);
		return true;
	}
	public function getCurrencyId()
	{
		return session('curr_id');
	}

	
}