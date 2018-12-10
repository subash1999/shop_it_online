<?php

namespace App\Http\Controllers\All_User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CartHelper;
use App\Http\Helpers\CurrencyHelper;
use App\Http\Helpers\SPPriceHistoryHelper;
use App\SPOptionRelation;
use App\SellerProduct;
use App\ShoppingCart;
use App\Wishlist;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     	// for currency symbol
    	$c_h = new CurrencyHelper;
    	$currency_symbol = $c_h->getCurrentCurrencySymbol();     			

    	$wl_all = $this->getCart();
    	$wl_items = $wl_all['wl_items'];
    	$total_items = $wl_all['total_items'];
    	/*Paginate the wishlist items*/
     	// Get current page form url e.x. &page=1
    	$currentPage = LengthAwarePaginator::resolveCurrentPage();

          // Create a new Laravel collection from the array data
    	$itemCollection = collect($wl_items);

          // Define how many items we want to be visible in each page
    	$perPage = 5;

          // Slice the collection to get the items to display in current page
    	$currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

          // Create our paginator and pass it to the view
    	$paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

          // set url path for generted links
    	$paginatedItems->setPath($request->url());
    	/*code for pagination ends here*/
    	return view('public/pages/wishlist',['wl_items'=>$paginatedItems,'currency_symbol'=>$currency_symbol,'total_items'=>$total_items]);
    }

    public function getCart()
    {   $wls = [];
    	$grand_total = 0;
    	$total_items = 0;
    	if(Auth::check()){
    		$user_id = Auth::id();
    		$db_wls = Wishlist::with('sellerProduct.SPPhotos')->where('user_id',$user_id)->get();
    		foreach ($db_wls as $key => $db_wl) {
    			$wl = [];
    			$wl["name"] = $db_wl->sellerProduct->sp_name1;
    			$total_items += 1;
    			// dd($db_wl->SellerProduct->sp_id);
    			$sph = new SPPriceHistoryHelper;
    			$c_h = new CurrencyHelper;
    			$wl['currency_symbol'] = $c_h->getCurrentCurrencySymbol();     			
    			$unit_price = $sph->getCurrentCurrencyPriceOfSellerProduct($db_wl->SellerProduct->sp_id);
    			$wl['unit_price'] = $unit_price;
    			$wl['wishlist_id'] = $db_wl->wishlist_id;
    			$wl['sp_id'] = $db_wl->sp_id;
    			$wl['spor_id'] = $db_wl->spor_id;
    			$spor_id =  $db_wl->spor_id;
    			$sp_id = $db_wl->sp_id;
    			$wl['photo'] = $db_wl->sellerProduct->SPPhotos[0]->photo;
    			$temp_cart = Wishlist::with('SPOptionRelation.option.optionGroup')->find($db_wl->wishlist_id);
    			$option_name = "";
    			$option_g_name = "";
    			$wl["option"] = "" ;
    			if ($temp_cart!=null) {
    				if($temp_cart->SPOPtionRelation!=null){
    					$option_name = $temp_cart->SPOPtionRelation->Option->option_name;
    					$option_g_name = $temp_cart->SPOPtionRelation->Option->OptionGroup->option_g_name;
    					$wl["option"] = $option_g_name. " :: ".$option_name;
    					$wl['photo'] =  $temp_cart->SPOPtionRelation->Option->photo;
    				}
    			}
    			
    			array_push($wls,$wl);     			

    		}     		
    	}
    	else{
    		$wishlists = session('wishlist');
    		if($wishlists==null){
    			$wishlists = [];
    		}
    		foreach ($wishlists as $key => $wl) {
    			$sp_id = $wl['sp_id'];
    			$spor_id = $wl['spor_id'];
    			$sp = SellerProduct::with('SPPhotos')->where('sp_id',$sp_id)->first();
    			$wl = [];
    			$wl["name"] = $sp->sp_name1;
    			$total_items += 1;
    			// dd($db_wl->SellerProduct->sp_id);
    			$sph = new SPPriceHistoryHelper;
    			$c_h = new CurrencyHelper;     		     			
    			$wl['currency_symbol'] = $c_h->getCurrentCurrencySymbol();     			
    			$unit_price = $sph->getCurrentCurrencyPriceOfSellerProduct($sp_id);
    			$wl['unit_price'] = $unit_price;      			
    			$wl['wallet_id'] = null;
    			$wl['sp_id'] = $sp_id;
    			$wl['spor_id'] = $spor_id;     			
    			$wl['photo'] = $sp->SPPhotos[0]->photo;
    			$option_name = "";
    			$option_g_name = "";
    			$wl["option"] = "" ;
    			if($spor_id!=null){
    				$spor = SPOptionRelation::with('option.optionGroup')->find($spor_id);
    				$option_name = $spor->Option->option_name;
    				$option_g_name = $spor->Option->OptionGroup->option_g_name;
    				$wl["option"] = $option_g_name. " :: ".$option_name;
    				$wl['photo'] =  $spor->Option->photo;
    			}
    			array_push($wls,$wl);     		
    		}

    	}    
    	$total_cart = [];
    	$total_cart["wl_items"]=$wls;
    	$total_cart['total_items'] = $total_items;
    	return $total_cart;
    }
}
