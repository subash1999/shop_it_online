<?php

namespace App\Http\Controllers\All_User;

use App\Category;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Helpers\CartHelper;
use App\Http\Helpers\CurrencyHelper;
use App\Http\Helpers\UserHelper;
use App\Http\Helpers\WishlistHelper;
use App\SPPriceHistory;
use Auth;
use Illuminate\Http\Request;

class PublicHeaderController extends Controller
{
	public function totalItemsInCart()
	{	$c_h = new CartHelper;
		return $c_h->getTotalNumberOfItems();
	}

	public function totalPriceOfCart()
	{
		$c_h = new CartHelper;
		return $c_h->getTotalPrice();
	}
	public function totalPriceOfCartWithCurrencySymbol()
	{
		$currency_helper = new CurrencyHelper;
		$symbol = $currency_helper->getCurrentCurrencySymbol();

		return $symbol." ".$this->totalPriceOfCart();
	}
	public function totalItemsInWishlist()
	{	$w_h = new WishlistHelper;
		return $w_h->getTotalNumberOfItems();
	}

	public function getSelectedCurrency()
	{
		$currency_helper = new CurrencyHelper;
		$symbol = $currency_helper->getCurrentCurrencySymbol();
		$u_h = new UserHelper;
		$curr_id = $u_h->getCurrentUserChoiceCurrencyId();
		$curr = Currency::find($curr_id);
		if($curr->currency_name!=$symbol){
			return $symbol." ".$curr->currency_name;
		}
		return $symbol;
	}
	public function selectCurrencyId($curr_id)
	{
		$u_h = new UserHelper;
		$u_h->setCurrentUserChoiceCurrencyId($curr_id);
		return back();
	}
	public function getCurrencyOptions()
	{
		$u_h = new UserHelper;
		$curr_id = $u_h->getCurrentUserChoiceCurrencyId();
		$currencies = Currency::where('curr_id','!=',$curr_id)->get();
		$options = [];
		$currency_helper = new CurrencyHelper;
		foreach ($currencies as $key => $currency) {
			$current_option = $currency_helper->getCurrencySymbol($currency->curr_id);
			if($currency_helper->getCurrencySymbol($currency->curr_id)!=$currency->currency_name){
				$current_option = $currency_helper->getCurrencySymbol($currency->curr_id)." ".$currency->currency_name;
			}
			$option = [];
			$option["curr_id"]=	$currency->curr_id;
			$option["option_name"] = $current_option;
			array_push($options,$option);
		}
		return json_encode($options);
	}
	public function getMainCategoryList()
	{
		$categories = Category::where('parent_cate',null)->get();
		$cate_list = [];
		foreach ($categories as $key => $category) {
			$cate = [];
			$cate["cate_id"]=$category->cate_id;
			$cate["cate_name"]=$category->cate_name;
			array_push($cate_list,$cate);
		}
		return $cate_list;
	}
}
