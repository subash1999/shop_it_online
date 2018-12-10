<?php

namespace App\Http\Controllers\All_User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CurrencyHelper;
use App\Http\Helpers\CartHelper;
use App\Http\Helpers\SPPriceHistoryHelper;
use App\SPOptionRelation;
use App\SellerProduct;
use App\Seller;
use App\ShoppingCart;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CartController extends Controller
{
  public function __construct()
  {
   $this->refreshCartItemQuantity();
 }
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

    $cart_all = $this->getCart();
    $cart_items = $cart_all['cart_items'];
    $grand_total = $cart_all['grand_total'];
    $total_items = $cart_all['total_items'];
    /*Paginate the cart items*/
     	// Get current page form url e.x. &page=1
    $currentPage = LengthAwarePaginator::resolveCurrentPage();

          // Create a new Laravel collection from the array data
    $itemCollection = collect($cart_items);

          // Define how many items we want to be visible in each page
    $perPage = 3;

          // Slice the collection to get the items to display in current page
    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

          // Create our paginator and pass it to the view
    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

          // set url path for generted links
    $paginatedItems->setPath($request->url());
    $paginatedItems = $cart_items;
    /*code for pagination ends here*/
    return view('public/pages/cart',['cart_items'=>$paginatedItems,'grand_total'=>$grand_total,'currency_symbol'=>$currency_symbol,'total_items'=>$total_items]);
  }

  public function getCart()
  { $this->refreshCartItemQuantity();
    $cts = [];
    $grand_total = 0;
    $total_items = 0;
    if(Auth::check()){
     $db_carts = ShoppingCart::with('sellerProduct.SPPhotos')->where('user_id',Auth::id())->get();
     foreach ($db_carts as $key => $db_cart) {
      $ct = [];
      $ct["name"] = $db_cart->sellerProduct->sp_name1;
      $ct['qty'] =  $db_cart->number_of_items;
      $ct['note'] = "";

      $total_items += $db_cart->number_of_items;
    	// dd($db_cart->SellerProduct->sp_id);
      $sph = new SPPriceHistoryHelper;
      $c_h = new CurrencyHelper;
      $ct['currency_symbol'] = $c_h->getCurrentCurrencySymbol();     			
      $unit_price = $sph->getCurrentCurrencyPriceOfSellerProduct($db_cart->SellerProduct->sp_id);
      $seller = Seller::find($db_cart->SellerProduct->seller_id);
      $ct['seller_id'] = " ";
      if($seller!=null){
        $ct['seller_id'] = $seller->seller_id;
        $ct['seller_company'] = $seller->company_name;
      }
      else{
        $ct['seller_company'] = "";
      }
      $ct['sc_id'] = $db_cart->sc_id;
      $ct['sp_id'] = $db_cart->sp_id;
      $ct['spor_id'] = $db_cart->spor_id;
      $spor_id =  $db_cart->spor_id;
      $sp_id = $db_cart->sp_id;
      $ct['photo'] = $db_cart->sellerProduct->SPPhotos[0]->photo;
      $ct['unit_price'] = $unit_price;
      $ct['total_price'] = $unit_price * $db_cart->number_of_items;
      if($spor_id!=null){
       $spor = SPOptionRelation::find($spor_id);
       $ct['max'] = $spor->number_of_items;
     }
     else{
       $sp = SellerProduct::find($sp_id);
       $ct['max'] = $sp->remaining;
     }     			
     $grand_total +=  round($unit_price * $db_cart->number_of_items,2);
     $temp_cart = ShoppingCart::with('SPOptionRelation.option.optionGroup')->find($db_cart->sc_id);
     $option_name = "";
     $option_g_name = "";
     $ct["option"] = "" ;
     if ($temp_cart!=null) {
       if($temp_cart->SPOPtionRelation!=null){
         $option_name = $temp_cart->SPOPtionRelation->Option->option_name;
         $option_g_name = $temp_cart->SPOPtionRelation->Option->OptionGroup->option_g_name;
         $ct["option"] = $option_g_name. " :: ".$option_name;
         $ct['photo'] =  $temp_cart->SPOPtionRelation->Option->photo;
       }
     }    
     if($db_cart->number_of_items<=0){
      $ct['note'] = "All the item is out of stock for this product so this has been removed form your cart";        
      $this->updateProductQtyInCartController($ct['sp_id'],$ct['spor_id'],0);
    }
    array_push($cts,$ct);     			

  }     		
}
else{
 $carts = session('shopping_cart');
 if($carts==null){
  $carts = [];
}
foreach ($carts as $key => $cart) {
  $sp_id = $cart['sp_id'];
  $spor_id = $cart['spor_id'];
  $sp = SellerProduct::with('SPPhotos')->where('sp_id',$sp_id)->first();
  $ct = [];
  $ct["name"] = $sp->sp_name1;
  $ct['qty'] =  $cart['number_of_items'];
  $ct['note'] = "";
  $total_items += $cart['number_of_items'];
		// dd($db_cart->SellerProduct->sp_id);
  $sph = new SPPriceHistoryHelper;
  $c_h = new CurrencyHelper;     		     			
  $ct['currency_symbol'] = $c_h->getCurrentCurrencySymbol();     			
  $unit_price = $sph->getCurrentCurrencyPriceOfSellerProduct($sp_id);
  $seller_product = SellerProduct::with('seller')->find($sp_id);
  $ct['seller_company'] = " ";
  $ct['seller_id'] = " ";      
  if($seller_product!=null){
    if($seller_product->Seller!=null){
      $ct['seller_id'] = $seller_product->Seller->seller_id;      
      $ct['seller_company'] = $seller_product->Seller->company_name;
    }     
  }   
  $ct['sc_id'] = null;
  $ct['sp_id'] = $sp_id;
  $ct['spor_id'] = $spor_id;     			
  $ct['photo'] = $sp->SPPhotos[0]->photo;
  $ct['unit_price'] = $unit_price;
  $ct['total_price'] = $unit_price * $cart['number_of_items'];
  $grand_total += round( $unit_price * $cart['number_of_items'],2);
  if($spor_id!=null){
   $spor = SPOptionRelation::find($spor_id);
   $ct['max'] = $spor->number_of_items;
 }
 else{
   $sp = SellerProduct::find($sp_id);
   $ct['max'] = $sp->remaining;
 }     	
 $option_name = "";
 $option_g_name = "";
 $ct["option"] = "" ;
 if($spor_id!=null){
   $spor = SPOptionRelation::with('option.optionGroup')->find($spor_id);
   $option_name = $spor->Option->option_name;
   $option_g_name = $spor->Option->OptionGroup->option_g_name;
   $ct["option"] = $option_g_name. " :: ".$option_name;
   $ct['photo'] =  $spor->Option->photo;
 }
 if($cart['number_of_items']<=0){
  $ct['note'] = "All the item is out of stock for this product so this has been removed form your cart";
  $this->updateProductQtyInCartController($ct['sp_id'],$ct['spor_id'],0);        
}
array_push($cts,$ct);     		
}

}
$total_cart = [];
$total_cart["cart_items"]=$cts;
$total_cart['grand_total'] = $grand_total;
$total_cart['total_items'] = $total_items;
return $total_cart;
}
public function refreshCartItemQuantity()
{
 if(Auth::check()){
  $db_carts = ShoppingCart::with('sellerProduct.SPPhotos')->where('user_id',Auth::id())->get();
  foreach ($db_carts as $key => $db_cart) {
    $ct = [];
    $ct['qty'] =  $db_cart->number_of_items;
    if($db_cart->SellerProduct->remaining<$db_cart->number_of_items){
      $db_cart->number_of_items = $db_cart->SellerProduct->remaining;
    }
    if($db_cart->spor_id!=null){
      $spor = SPOptionRelation::find($db_cart->spor_id);
      if($spor->number_of_items<$db_cart->number_of_items){
        $db_cart->number_of_items = $spor->number_of_items;
      }
    }
    if ( $db_cart->number_of_items<=0) {
     $db_cart->number_of_items = 0;
     $db_cart->delete();
   }
   else{
    $db_cart->save();
   }   


 }
}
else{
  $carts = session('shopping_carts');
  $new_carts = [];
  if($carts==null){
    $carts = [];
  }
  foreach ($carts as $cart) {
    $sp = SellerProduct::find($cart['sp_id']);
    $ct = [];
    $ct['spor_id'] = $cart['spor_id'];
    $ct['sp_id'] = $cart['sp_id'];
    $ct['number_of_items'] =  $cart['number_of_items'];
    if($sp->remaining<$ct['number_of_items']){
      $ct['number_of_items'] = $sp->remaining;
    }
    if($ct['spor_id']!=null){
      $spor = SPOptionRelation::find($ct['spor_id']);
      if($spor->number_of_items<$ct['number_of_items']){
        $ct['number_of_items'] = $spor->number_of_items;    

      }        
    }
    if ( $ct['number_of_items']==0) {
      $ct['number_of_items'] = 0;
    }
    else{
      array_push($new_carts, $ct);
    }
  }
  session(['shopping_carts'=>$new_carts]);
}
}
public function getSingleProductCartValues(Request $request)
{
  $sp_id = $request->sp_id;
  $spor_id = $request->spor_id;
  if($spor_id == ""){
   $spor_id= null;
 }
 $grand_total = 0;
 $ct = [];
 if(Auth::check()){
  $db_cart = ShoppingCart::with('sellerProduct.SPPhotos')->where('user_id',Auth::id())->where('sp_id',$sp_id)->where('spor_id',$spor_id)->first();       	
  if($db_cart==null){
    $ct["name"]="";
    $ct['qty'] ="";
    $ct['currency_symbol'] = "";
    $ct['sc_id'] = "";
    $ct['notice']="";
    $ct['company_name'] = "";
    $ct['sp_id'] = "";
    $ct['spor_id'] = "";
    $ct['photo'] =  "";
    $ct['unit_price'] ="";
    $ct['total_price'] ="";
    $ct['max'] = "";
    $ct["option"] = "" ;
    return $ct;
  }

  $ct["name"] = $db_cart->sellerProduct->sp_name1;
  $ct['qty'] =  $db_cart->number_of_items;
    			// dd($db_cart->SellerProduct->sp_id);
  $sph = new SPPriceHistoryHelper;
  $c_h = new CurrencyHelper;
  $ct['currency_symbol'] = $c_h->getCurrentCurrencySymbol();     			
  $unit_price = $sph->getCurrentCurrencyPriceOfSellerProduct($db_cart->SellerProduct->sp_id);
  $ct['sc_id'] = $db_cart->sc_id;
  $ct['notice'] = "";
  $ct['sp_id'] = $db_cart->sp_id;
  $ct['spor_id'] = $db_cart->spor_id;
  $spor_id =  $db_cart->spor_id;
  $sp_id = $db_cart->sp_id;
  $ct['photo'] = $db_cart->sellerProduct->SPPhotos[0]->photo;
  $ct['unit_price'] = $unit_price;
  $ct['total_price'] = round($unit_price * $db_cart->number_of_items,2);
  if($spor_id!=null){
    $spor = SPOptionRelation::find($spor_id);
    $ct['max'] = $spor->number_of_items;
  }
  else{
    $sp = SellerProduct::find($sp_id);
    $ct['max'] = $sp->remaining;
  }     			
  $grand_total +=  round($unit_price * $db_cart->number_of_items,2);
  $temp_cart = ShoppingCart::with('SPOptionRelation.option.optionGroup')->find($db_cart->sc_id);
  $seller = Seller::find($db_cart->SellerProduct->seller_id);
  $ct['seller_id'] = " ";      
  if($seller!=null){
    $ct['seller_id'] = $seller->seller_id;   
    $ct['seller_company'] = $seller->company_name;
  }
  else{
    $ct['seller_company'] = "";
  }
  $option_name = "";
  $option_g_name = "";
  $ct["option"] = "" ;
  if ($temp_cart!=null) {
    if($temp_cart->SPOPtionRelation!=null){
      $option_name = $temp_cart->SPOPtionRelation->Option->option_name;
      $option_g_name = $temp_cart->SPOPtionRelation->Option->OptionGroup->option_g_name;
      $ct["option"] = $option_g_name. " :: ".$option_name;
      $ct['photo'] =  $temp_cart->SPOPtionRelation->Option->photo;
    }
  }
 


}
else{
 $carts = session('shopping_cart');
 if($carts==null){
   $carts = [];
 }

 $ct = [];
 foreach ($carts as $key => $cart) {
   if ($cart['sp_id']==$sp_id && $cart['spor_id']==$spor_id) {
     $sp_id = $cart['sp_id'];
     $spor_id = $cart['spor_id'];
     $sp = SellerProduct::with('SPPhotos')->where('sp_id',$sp_id)->first();
     $ct['notice'] = "";
     $ct["name"] = $sp->sp_name1;
     $ct['qty'] =  $cart['number_of_items'];
     $sph = new SPPriceHistoryHelper;
     $c_h = new CurrencyHelper;     		     			
     $ct['currency_symbol'] = $c_h->getCurrentCurrencySymbol();     			
     $unit_price = $sph->getCurrentCurrencyPriceOfSellerProduct($sp_id);
     $seller_product = SellerProduct::with('seller')->find($sp_id);
     $ct['seller_company'] = " ";
     if($seller_product!=null){
      if($seller_product->Seller!=null){
        $ct['seller_id'] = $seller_product->Seller->seller_id;        
        $ct['seller_company'] = $seller_product->Seller->company_name;
      }     
    }   
    $ct['sc_id'] = null;
    $ct['sp_id'] = $sp_id;
    $ct['spor_id'] = $spor_id;     			
    $ct['photo'] = $sp->SPPhotos[0]->photo;
    $ct['unit_price'] = $unit_price;
    $ct['total_price'] = round($unit_price * $cart['number_of_items'],2);
    $grand_total += round($unit_price * $cart['number_of_items'],2);
    if($spor_id!=null){
     $spor = SPOptionRelation::find($spor_id);
     $ct['max'] = $spor->number_of_items;
   }
   else{
     $sp = SellerProduct::find($sp_id);
     $ct['max'] = $sp->remaining;
   }     	
   $option_name = "";
   $option_g_name = "";
   $ct["option"] = "" ;
   if($spor_id!=null){
     $spor = SPOptionRelation::with('option.optionGroup')->find($spor_id);
     $option_name = $spor->Option->option_name;
     $option_g_name = $spor->Option->OptionGroup->option_g_name;
     $ct["option"] = $option_g_name. " :: ".$option_name;
     $ct['photo'] =  $spor->Option->photo;
   }
  					
}
}
if(count($ct)==0){
  $ct["name"]="";
  $ct['qty'] ="";
  $ct['currency_symbol'] = "";
  $ct['sc_id'] = "";
  $ct['sp_id'] = "";
  $ct['company_name'] = "";
  $ct['spor_id'] = "";
  $ct['photo'] =  "";
  $ct['unit_price'] ="";
  $ct['total_price'] ="";
  $ct['max'] = "";
  $ct["option"] = "" ;     		
  $ct['note'] = "";		
}

}
return $ct;

}
public function getGrandTotalOfCart()
{
  $this->refreshCartItemQuantity();
  $c_h = new CartHelper;
  return $c_h->getTotalPrice();
}
public function updateProductQtyInCart(Request $request)
{
 $result = false;
 $new_qty = $request->qty;
 $spor_id = $request->spor_id;
 $sp_id = $request->sp_id;
 $c_h = new CartHelper;
     	// if it is a seller product with no option then spor_id is null
 if($spor_id==null){
   $old_store_qty = $c_h->getQuantityOfSellerProductInCart($sp_id);
 }
     	// else if spor_id is not null then we have to check the options
 else{
   $old_store_qty = $c_h->getQuantityOfSPOptionRelationInCart($spor_id); 
 }
 if($old_store_qty==$new_qty){
   return "true";
 }     	
     	// changing the qty if everything is all right and old and new value are not equal
     	// for seller product with no option at first
 if($spor_id==null){
     		// if product cannot be added due to excedding total number of available products then
   $number_of_items = $new_qty;
   if(!$c_h->canUpdateSellerProductInExistingProductCart($sp_id,$number_of_items)){
     $msg = "The maximum quantity available for this product in cart is : ".$c_h->getAvailableSellerProductCount($sp_id)."<br>"."Current cart quantity of this product is : ".$c_h->getQuantityOfSellerProductInCart($sp_id);
     return $msg;
   }
   if($c_h->updateSellerProductInCart($sp_id,$number_of_items)){
     $result = "true";
   }    		
 }
 else{
     		// if product cannot be added due to excedding total number of available products then
  $number_of_items = $new_qty;
  if(!$c_h->canUpdateSPOptionRelationInExistingProductCart($spor_id,$number_of_items)){
    $msg = "The maximum quantity available for this product option in cart is : ".$c_h->getAvailableSPOptionRelationCount($spor_id)."<br>"."Current cart quantity of this product is : ".$c_h->getQuantityOfSPOptionRelationInCart($spor_id);
    return $msg;
  }
  if($c_h->updateSPOptionRelationInCart($spor_id,$number_of_items)){
    $result = "true";
  }    		
}
if($result){
  $result = "true";
}
else{
  $result = "false";
}
return $result;
}
public function updateProductQtyInCartController($sp_id,$spor_id,$qty)
{
 $result = false;
 $new_qty = $qty;
 $spor_id = $spor_id;
 $sp_id = $sp_id;
 $c_h = new CartHelper;
      // if it is a seller product with no option then spor_id is null
 if($spor_id==null){
   $old_store_qty = $c_h->getQuantityOfSellerProductInCart($sp_id);
 }
      // else if spor_id is not null then we have to check the options
 else{
   $old_store_qty = $c_h->getQuantityOfSPOptionRelationInCart($spor_id); 
 }
 if($old_store_qty==$new_qty){
   return "true";
 }      
      // changing the qty if everything is all right and old and new value are not equal
      // for seller product with no option at first
 if($spor_id==null){
        // if product cannot be added due to excedding total number of available products then
   $number_of_items = $new_qty;
   if(!$c_h->canUpdateSellerProductInExistingProductCart($sp_id,$number_of_items)){
     $msg = "The maximum quantity available for this product in cart is : ".$c_h->getAvailableSellerProductCount($sp_id)."<br>"."Current cart quantity of this product is : ".$c_h->getQuantityOfSellerProductInCart($sp_id);
     return $msg;
   }
   if($c_h->updateSellerProductInCart($sp_id,$number_of_items)){
     $result = "true";
   }        
 }
 else{
        // if product cannot be added due to excedding total number of available products then
  $number_of_items = $new_qty;
  if(!$c_h->canUpdateSPOptionRelationInExistingProductCart($spor_id,$number_of_items)){
    $msg = "The maximum quantity available for this product option in cart is : ".$c_h->getAvailableSPOptionRelationCount($spor_id)."<br>"."Current cart quantity of this product is : ".$c_h->getQuantityOfSPOptionRelationInCart($spor_id);
    return $msg;
  }
  if($c_h->updateSPOptionRelationInCart($spor_id,$number_of_items)){
    $result = "true";
  }       
}
if($result){
  $result = "true";
}
else{
  $result = "false";
}
return $result;
}
}
