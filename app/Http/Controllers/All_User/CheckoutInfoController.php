<?php

namespace App\Http\Controllers\All_User;

use App\Bill;
use App\BillTransistionRelation;
use App\DiscountCoupon;
use App\Http\Controllers\Controller;
use App\Http\Helpers\CartHelper;
use App\Http\Helpers\CurrencyHelper;
use App\Http\Helpers\SPPriceHistoryHelper;
use App\Http\Helpers\UserHelper;
use App\Http\Requests\BuyProducts;
use App\Mail\BillMail;
use App\Mail\ConfirmPuarchase;
use App\PaymentMethod;
use App\SPOptionRelation;
use App\Seller;
use App\SellerProduct;
use App\SellerStock;
use App\SellerStockHistory;
use App\ShoppingCart;
use App\TransistionHistory;
use App\Wallet;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Validator;

class CheckoutInfoController extends Controller
{
    /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
    public function index(Request $request)
    {
      // dd($request->items);
     $u_h = new UserHelper;
     $currency_helper = new CurrencyHelper;
     $rules = [];
     $messages['item'] = 'required';

     $info = [];

     $info['discount_value'] = 0;
     $info['dc_id'] = 0;
     $coupon = null;
     if($request->discount_coupon!=null){
      $rules['discount_coupon'] = 'required|exists:discount_coupons,coupon_code'; 
      $coupon = DiscountCoupon::where('coupon_code',$request->discount_coupon)->where('user_id',Auth::id())->valid()->first();
      if($coupon==null){
        $rules['discount_coupon_valid'] = 'required';
        $messages['discount_coupon_valid.required']  = 'The discount coupon you entered is invalid!! please enter a valid one'; 

      }else{
        $current_curr_id = $u_h->getCurrentUserChoiceCurrencyId();
        $dis_amount = $currency_helper->currencyConvert($coupon->curr_id,$current_curr_id,$coupon->amount);
        // dd($dis_amount);
        $info['discount_value'] = round($dis_amount,2);       
        $info['dc_id'] = $coupon->dc_id;
      }

    }
    if($request->items==null){
      abort(404,"There are no items for checkout , please proceed form the cart again");
    }         
    foreach ($request->items as $item) {
      if(!isset($item['sp_id'])){
        $rules['sp_not_set'] = 'required'; 
        $messages['sp_not_set.required']='Data is corrupted so please revisit the checkout from cart'; 
      }
    }
    $validator = Validator::make($request->all(), $rules,$messages);
    if ($validator->fails()) {
      return back()
      ->withErrors($validator)
      ->withInput();
    }    	
    $wallet_sufficient = false;
    $info['name'] = "";
    $total_items = 0;
    $info['email'] = "";
    $info['phone'] = "";
    $info['bill_address'] = "";
    $info['bill_city'] = "";
    $info['bill_country'] = '';
    $info['ship_address'] = "";
    $info['ship_city'] = "";
    $info['ship_country'] = '';
    $info['total_price'] = 0;
    $info['curr_id'] = 0;

    $info['curr_id'] = $u_h->getCurrentUserChoiceCurrencyId();
    $info['cash_on_deliver_id'] = "cash";
    $info['cash_on_deliver_method'] = "Cash On Delivery";

    $info["currency_symbol"] =  $currency_helper->getCurrentCurrencySymbol(); 
    $pay_m = null;
    if ($pay_m!=null) {
      $info['cash_on_deliver_id'] = $pay_m->pay_m_id;
      $info['cash_on_deliver_method'] = $pay_m->method;

    }
    $checkout_items = [];
    if($request->items==null){
      abort(404,'No Items to checkout');
    }
    $grand_total = 0;
    foreach ($request->items as $item) {
      $sp_id = $item['sp_id'];
      $spor_id = $item['spor_id'];
      $ck_item = $this->getSingleProductCartValues($sp_id,$spor_id);
      $grand_total += $ck_item['total_price'];
      $total_items += (int) $ck_item['qty']; 

      array_push($checkout_items, $ck_item);     
    }
    if(Auth::check()){

      if(Auth::user()->getCurrentWallet()!=null){
        $wallet = Auth::user()->getCurrentWallet();
        if($wallet!=null){
          if($wallet->amount>=$grand_total){
            $wallet_sufficient = true;
          }
        }
      }
      $info['name'] = Auth::user()->getFullName();
      $info['email'] = Auth::user()->getEmail();
      $info['phone'] = Auth::user()->getPhone();
      $info['bill_address'] = Auth::user()->getAddress();  
      $info['ship_address'] = Auth::user()->getAddress();
      $info['bill_city'] = Auth::user()->getCity();  
      $info['ship_city'] = Auth::user()->getCity();
      $info['bill_country'] = Auth::user()->getCountry(); 
      $info['ship_country'] = Auth::user()->getCountry();      
    }
    $info['total_price'] = $grand_total;
    $info['total_items'] = $total_items;
    $info['total_price_note'] = "";
    if ($info['discount_value']>=(0.2*$grand_total)) {
     $info['total_price_note'] = "Note : The original discount was ".$info['currency_symbol']." ".$info['discount_value']." but it exceded out 20% of total price discount policy so your discount is only 20% of the total price i.e. ".$info['currency_symbol']." ".(0.2*$grand_total);
     $info['discount_value']=(0.2*$grand_total);     

   }
   return view('public/pages/checkout_info',['info'=>$info,'total_items'=>$total_items,'wallet_sufficient'=>$wallet_sufficient,'items'=>$request->items]);
 }
 public function confirmPuarchaseByEmail(BuyProducts $request)
 {   
  // send a mail and then redirect to the confirm order by email page
  Mail::send(new ConfirmPuarchase());
  return redirect('checkout/confirm_order');
  
}
public function buyProductsGetMethod(Request $request)
{  
  // dd($request->all());
  // only pass the data here
  $this->actionOfBuyingProducts(json_decode($request->data));
}
public function buyProducts(BuyProducts $request)
{
  // only pass the data here
  $this->actionOfBuyingProducts($request);
}
public function actionOfBuyingProducts($request)
{
  // dd(strcasecmp("Wallet",$request->pay_method));
  // dd($request->all());  
  // dd(strcasecmp("Wallet",$request->pay_method)==0);
  DB::beginTransaction();
  try {
    $dis_fraction = ($request->total_price - $request->payable_amount)/$request->total_price;
    $here_total_price = 0;
    $here_payable_price = 0;
    $u_h = new UserHelper;
    $th_ids = [];
    foreach ((array) $request->items as $item) {
      $item = (array) $item;
      $th = new TransistionHistory;
      $th->user_id = Auth::id();
      $th->sp_id = $item['sp_id'];
      $th->spor_id = $item['spor_id'];
      $sp = SellerProduct::find($item['sp_id']);
      if($sp==null){
        abort(404,'The Product(s) You want to buy is not available');
      }
      $th->unit_price = $sp->getCurrentCurrencyPriceOfSellerProduct();
      $here_total_price = $sp->getCurrentCurrencyPriceOfSellerProduct();
      $th->curr_id = $u_h->getCurrentUserChoiceCurrencyId();
      if($sp->remaining<$item['qty']){
        abort(404,'The Product(s) You want to buy is sold out');
      }
      $th->quantity = $item['qty'];
      $th->final_unit_price = (1-$dis_fraction)* $sp->getCurrentCurrencyPriceOfSellerProduct();
      $here_payable_price += (1-$dis_fraction)* $sp->getCurrentCurrencyPriceOfSellerProduct();
      if(!$th->save()){
        foreach ($th_ids as $th_id) {
          $t_his = TransistionHistory::find($th_id);
          $t_his->forceDelete();
        }
      }
      array_push($th_ids,$th->th_id);
    }
    // creating a bill
    $bill = new Bill;
    $bill->name = $request->name;
    $bill->bill_address = $request->bill_address;
    $bill->bill_city = $request->bill_city;
    $bill->bill_country = $request->bill_country;
    $bill->ship_address = $request->ship_address;
    $bill->ship_city = $request->ship_city;
    $bill->ship_country = $request->ship_country;
    $bill->email = $request->email;
    if(strcasecmp("Wallet",$request->pay_method)==0){
      $bill->payment_status = "Paid";  
      $bill->product_status = "Confirmed";
    }
    else {
      $bill->payment_status = "Pending"; 
      $bill->product_status = "To be Confirmed"; 
    }
    $coupon = DiscountCoupon::find($request->dc_id);
    if($coupon!=null){
     $bill->dc_id = $coupon->dc_id;
   }
   $discount_amount = 0;
   if($coupon != null){
    $discount_amount = $request->total_price - $request->payable_amount;
  }
  $bill->discount_amount = $discount_amount;
  $bill->user_id = Auth::id();
  $bill->total_amount = $request->total_price;
  $bill->final_amount = $request->payable_amount;
  $bill->curr_id = $request->curr_id;
  $bill->phone1 = $request->country_code." ".$request->phone;
  if(!$bill->save()){
   foreach ($th_ids as $th_id) {
    $t_his = TransistionHistory::find($th_id);
    $t_his->forceDelete();
  }
}
$ss_ids = [];
foreach ((array)$request->items as $item) {
  $item = (array) $item;
  $sp = SellerProduct::find($item['sp_id']);
  // now changing the available
  $sp->sold ++;
  $sp->remaining--;
  $sp->save();
  if($item['spor_id']!=null){
    $spor = SPOptionRelation::find($item['spor_id']);
    $spor->number_of_items--;
    $spor->save();
  }
  $ss = new SellerStock;
  $ss->sp_id = $item['sp_id'];
  $ss->available = $sp->remaining;
  $ss->total_bought = 0;
  $ss->total_sold= 0;
  if(!$ss->save()){
    $bill->forceDelete();
    foreach ($th_ids as $th_id) {
      $t_his = TransistionHistory::find($th_id);
      $t_his->forceDelete();
    }
    foreach ($ss_ids as $ss_id) {
      $ss = SellerStock::find($ss_id);
      $ss->forceDelete();
    }
  }
  array($ss_ids,$ss->ssh_id);
}
// bill th relation
$rel_ids = [];
foreach ($th_ids as $th_id) {
  $rel = new BillTransistionRelation;
  $rel->bill_id = $bill->bill_id; 
  $rel->th_id = $th_id;
  if(!$rel->save()){
    $ss->forceDelete();
    $bill->forceDelete();
    foreach ($th_ids as $th_id) {
      $t_his = TransistionHistory::find($th_id);
      $t_his->forceDelete();
    }
    foreach ($rel_ids as $rel_id) {
      $rel = BillTransistionRelation::find($rel_id);
      $rel->forceDelete();
    }
    foreach ($ss_ids as $ss_id) {
      $ss = SellerStock::find($ss_id);
      $ss->forceDelete();
    }
  }  
  array_push($rel_ids,$rel->btr_id);
}



if($coupon!=null){
  // if coupon is present
  $coupon->delete();
}
if(strcasecmp("Wallet",$request->pay_method)==0){
  if(Auth::check()){
    $wallet = Auth::user()->getCurrentWallet();
    $wallet_amount = $wallet->getAmountInCurrencyGiven($request->curr_id);
    // dd($wallet_amount);
    $new_wallet = new Wallet;
    $new_wallet->curr_id = $request->curr_id;
    $new_wallet->amount = $wallet_amount - $request->payable_amount;
    $new_wallet->debit = $request->payable_amount;
    $new_wallet->description = "Buying of product(s),
     Bill no :: ".$bill->bill_id;
    $new_wallet->user_id = Auth::id();
    $new_wallet->save();
    // dd($wallet);
  }
}
foreach ((array)$request->items as $item) {
  $item = (array) $item;
  $c_h =new CartHelper;
  if($item['spor_id']!=null){
    $c_h->removeSPOptionRelationInCart($item['spor_id']);
  }
  else{
    $c_h->removeSellerProductInCart($item['sp_id']);
  }
}

DB::commit();
$request->bill_id = $bill->bill_id;
Mail::send(new BillMail($bill->bill_id,$bill->email));
return redirect('/')->with('bill_sending_success','Your bill was sent to you at the email you provided');
} catch (Exception $e) {
  DB::rollback();


}
return redirect('')->with('bill_sending_fail','Your bill was sent to you at the email you provided');


}

public function sendNotificationMail(){

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
