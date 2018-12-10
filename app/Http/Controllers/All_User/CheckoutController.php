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

class CheckoutController extends Controller
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
        $checkout_items = [];
        $items = $request->items;
    	// dd($request->all());
        $grand_total = 0;
        $total_items = 0;
        if($items==null){
            abort(404,'No Items to checkout');
        }
           foreach ($items as $item) {
              $sp_id = $item['sp_id'];
              $spor_id = $item['spor_id'];
              $ck_item = $this->getSingleProductCartValues($sp_id,$spor_id);
              $grand_total += $ck_item['total_price'];
              $total_items += $ck_item['qty']; 
              array_push($checkout_items, $ck_item);
          }

          /*code for pagination ends here*/
          return view('public/pages/checkout',['cart_items'=>$checkout_items,'grand_total'=>$grand_total,'currency_symbol'=>$currency_symbol,'total_items'=>$total_items]);
      }
      public function getSingleProductCartValues($sp_id,$spor_id)
      {
       if($spor_id == ""){
          $spor_id= null;
      }
      $grand_total = 0;
      $ct = [];
      if(Auth::check()){
          $db_cart = ShoppingCart::with('sellerProduct.SPPhotos')->where('user_id',Auth::id())->where('sp_id',$sp_id)->where('spor_id',$spor_id)->first();       	
          if($db_cart==null){
             $ct["name"]="";
             $ct['qty'] =0;
             $ct['currency_symbol'] = "";
             $ct['company_name'] = "";
             $ct['sc_id'] = "";
             $ct['sp_id'] = "";
             $ct['spor_id'] = "";
             $ct['photo'] =  "";
             $ct['unit_price'] =0;
             $ct['total_price'] =0;
             $ct['max'] = 0;
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
 $ct['qty'] =0;
 $ct['currency_symbol'] = "";
 $ct['company_name'] = "";
 $ct['sc_id'] = "";
 $ct['sp_id'] = "";
 $ct['spor_id'] = "";
 $ct['photo'] =  "";
 $ct['unit_price'] =0;
 $ct['total_price'] =0;
 $ct['max'] = 0;
 $ct["option"] = "" ;     				
}

}
return $ct;

}
}
