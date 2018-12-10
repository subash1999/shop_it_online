<?php 
 /**
  * 
  */

 namespace App\Http\Helpers;

 use App\Http\Helpers\SPPriceHistoryHelper;
 use App\SPPriceHistory;

 use App\SPOptionRelation;

 use App\Wishlist;

 use App\CategoryProductRelation;
 use App\SellerProduct;
 use Auth;
 use App\Category;
 use App\ShoppingCart;

 class CartHelper	
 {
 	
 	public function isSPOPtionRelationInCart($spor_id)
 	{ 		
 		$ret = false;
 		$spor = SPOptionRelation::find($spor_id);
 		$sp_id = $spor->sp_id;
 		if(Auth::check()){
 			$cart_count = ShoppingCart::with('SPOPtionRelation')->where('spor_id',$spor_id)->where('user_id',Auth::user()->user_id)->where('sp_id',$sp_id)->count();
 			if($cart_count>0){
 				$ret = true;
 			}
 		}
 		else{
 			$carts = session('shopping_cart');
 			
 			if($carts!=null){

 				if(is_array($carts)){
 					foreach ($carts as $cart) {

 						if($cart["spor_id"]===$spor_id && $cart['sp_id']==$sp_id){

 							$ret = true;
 						}
 					}
 					
 				}
 			}
 			
 		}
 		return $ret;
 	}

 	public function isSellerProductInCart($sp_id)
 	{
 		// for the sp and with no option only 
 		// only the product with no option can be added to the wishlist for spor =0
 		// so to check the seller product in wishlist we have to make sure it has no option

 		$ret = false;
 		if(Auth::check()){
 			$cart_count = ShoppingCart::where('sp_id',$sp_id)->where('spor_id',null)->where('user_id',Auth::user()->user_id)->count();
 			if($cart_count>0){
 				$ret = true;
 			}
 		}
 		else{
 			$carts = session('shopping_cart');
 			if($carts!=null){
 				if(is_array($carts)){
 					foreach ($carts as $cart) {
 						if($cart["sp_id"]===$sp_id && $cart['spor_id']==null){
 							$ret = true;
 						}
 					}
 					
 				}
 			}
 			
 		}
 		return $ret; 		
 		
 	}
 	public function getQuantityOfSellerProductInCart($sp_id)
 	{
 		if (Auth::check()) {
 			$user_id = Auth::id();
 			$cart = ShoppingCart::where('sp_id',$sp_id)->where('user_id',$user_id)->where('spor_id',null)->first();
 			if($cart!=null){
 				return $cart->number_of_items;
 			}
 		}	
 		else{
 			$carts = session('shopping_cart');
 			foreach ($carts as $key => $cart) {
 				if ($cart['spor_id']==null && $cart['sp_id']==$sp_id) {
 					return $cart['number_of_items'];
 				}
 			}
 		}
 		return "NA";

 	}
 	public function getQuantityOfSPOptionRelationInCart($spor_id)
 	{
 		$spor = SPOptionRelation::find($spor_id);
 		$sp_id = $spor->sp_id;
 		if (Auth::check()) {
 			$user_id = Auth::id();
 			$cart = ShoppingCart::where('sp_id',$sp_id)->where('user_id',$user_id)->where('spor_id',$spor_id)->first();
 			if($cart!=null){
 				return $cart->number_of_items;
 			}
 		}	
 		else{
 			$carts = session('shopping_cart');
 			foreach ($carts as $key => $cart) {
 				if ($cart['spor_id']==$spor_id && $cart['sp_id']==$sp_id) {
 					return $cart['number_of_items'];
 				}
 			}
 		}
 		return "NA";
 	}
 	public function getAvailablSellerProductCount($sp_id)
 	{
 		$sp = SellerProduct::find($sp_id);
 		return $sp->remaining;
 	}
 	public function getAvailableSPOptionRelationCount($spor_id)
 	{
 		$spor = SPOptionRelation::find($spor_id);
 		return $spor->number_of_items;
 	}
 	public function canAddSellerProductInExistingProductCart($sp_id,$number_of_items) {
 		$ret= false;
 		if($this->isSellerProductInCart($sp_id)){ 			
 			if(Auth::check()){
 				$cart = ShoppingCart::with('sellerProduct')->where('sp_id',$sp_id)->where('spor_id',null)->where('user_id',Auth::user()->user_id)->first();
 				if($cart!=null){
 					$total_qty = $cart->number_of_items+$number_of_items;
 					if($this->getAvailablSellerProductCount($sp_id)>=$total_qty){
 						$ret = true;
 					} 				

 				}
 			}
 			else{
 				$carts = session('shopping_cart');
 				if($carts!=null){
 					if(is_array($carts)){
 						foreach ($carts as $cart) {
 							if($cart["sp_id"]===$sp_id && $cart['spor_id']==null){
 								$total_qty = $cart["number_of_items"]+$number_of_items;
 								if($this->getAvailablSellerProductCount($sp_id)>=$total_qty){
 									$ret = true;
 								} 								
 							}
 						}

 					}
 				}

 			}


 		}
 		// if seller product is not in the cart then can_add is true
 		else{
 			$ret = true;
 		}
 		return $ret; 
 	}
 	public function canUpdateSellerProductInExistingProductCart($sp_id,$number_of_items) {
 		$ret= false;
 		if($this->isSellerProductInCart($sp_id)){ 			
 			if(Auth::check()){
 				$cart = ShoppingCart::with('sellerProduct')->where('sp_id',$sp_id)->where('spor_id',null)->where('user_id',Auth::user()->user_id)->first();
 				if($cart!=null){
 					$total_qty =$number_of_items;
 					if($this->getAvailablSellerProductCount($sp_id)>=$total_qty&&$total_qty>=0){
 						$ret = true;
 					} 				

 				}
 			}
 			else{
 				$carts = session('shopping_cart');
 				if($carts!=null){
 					if(is_array($carts)){
 						foreach ($carts as $cart) {
 							if($cart["sp_id"]===$sp_id && $cart['spor_id']==null){
 								$total_qty =$number_of_items;
 								if($this->getAvailablSellerProductCount($sp_id)>=$total_qty&&$total_qty>=0){
 									$ret = true;
 								} 								
 							}
 						}

 					}
 				}

 			}


 		}
 		// if seller product is not in the cart then can_add is true
 		else{
 			$ret = true;
 		}
 		return $ret; 
 	}
 	public function canAddSPOptionRelationInExistingProductCart($spor_id,$number_of_items){
 		$spor = SPOptionRelation::find($spor_id);
 		$sp_id = $spor->sp_id;
 		$ret= false;
 		if($this->isSPOptionRelationInCart($spor_id)){ 			
 			if(Auth::check()){
 				$cart = ShoppingCart::with('sellerProduct')->where('sp_id',$sp_id)->where('spor_id',$spor_id)->where('user_id',Auth::user()->user_id)->first();
 				if($cart!=null){
 					$total_qty = $cart->number_of_items+$number_of_items;
 					if($this->getAvailableSPOptionRelationCount($spor_id)>=$total_qty){
 						$ret = true;
 					} 				

 				}
 			}
 			else{
 				$carts = session('shopping_cart');
 				if($carts!=null){
 					if(is_array($carts)){
 						foreach ($carts as $cart) {
 							if($cart["sp_id"]==$sp_id && $cart['spor_id']==$spor_id){
 								$total_qty = $cart["number_of_items"]+$number_of_items;
 								if($this->getAvailableSPOptionRelationCount($spor_id)>=$total_qty){
 									$ret = true;
 								} 								
 							}
 						}

 					}
 				}

 			}


 		}
 		// if seller product is not in the cart then can_add is true
 		else{
 			$ret = true;
 		}
 		return $ret; 
 	}
 	public function canUpdateSPOptionRelationInExistingProductCart($spor_id,$number_of_items) {
 		$spor = SPOptionRelation::find($spor_id);
 		$sp_id = $spor->sp_id;
 		$ret= false;
 		if($this->isSPOptionRelationInCart($spor_id)){ 			
 			if(Auth::check()){
 				$cart = ShoppingCart::with('sellerProduct')->where('sp_id',$sp_id)->where('spor_id',$spor_id)->where('user_id',Auth::user()->user_id)->first();
 				if($cart!=null){
 					$total_qty = $number_of_items;
 					if($this->getAvailableSPOptionRelationCount($spor_id)>=$total_qty&&$total_qty>=0){
 						$ret = true;
 					} 				

 				}
 			}
 			else{
 				$carts = session('shopping_cart');
 				if($carts!=null){
 					if(is_array($carts)){
 						foreach ($carts as $cart) {
 							if($cart["sp_id"]==$sp_id && $cart['spor_id']==$spor_id){
 								$total_qty =$number_of_items;
 								if($this->getAvailableSPOptionRelationCount($spor_id)>=$total_qty&&$total_qty>=0){
 									$ret = true;
 								} 								
 							}
 						}

 					}
 				}

 			}


 		}
 		// if seller product is not in the cart then can_add is true
 		else{
 			$ret = true;
 		}
 		return $ret; 
 	}

 	public function addSellerProductInCart($sp_id,$number_of_items)   {
 		
 		$result = false;
 		// if seller product is already in the cart then update the cart if possible 
 		if($this->isSellerProductInCart($sp_id)){
 			// update the existing cart if possible in the cart
 			// if cannot add the seller product in the cart then return false,
 			// else the code below will execute
 			if(!$this->canAddSellerProductInExistingProductCart($sp_id,$number_of_items)){
 				return false;
 			}
 			if(Auth::check()){
 				$user_id = Auth::user()->user_id;
 				$cart = ShoppingCart::where('sp_id',$sp_id)->where('user_id',$user_id)->where('spor_id',null)->first();
 				$cart->sp_id = $sp_id;
 				$cart->user_id = $user_id;
 				$cart->spor_id = null;
 				$cart->number_of_items =$cart->number_of_items + $number_of_items;
 				$cart->save();
 				$result = true;
 			}
 			else{
 				$carts = array();
 				if(session('shopping_cart')!=null){
 					$carts = session('shopping_cart'); 				
 					foreach ($carts as $key => $cart) {
 						if($cart["spor_id"]==null && $cart["sp_id"]==$sp_id){
 							$carts[$key]['number_of_items'] = $carts[$key]['number_of_items'] + $number_of_items;
 						}
 					}
 				} 				
 				session(['shopping_cart'=>$carts]);
 				$result = true;          
 			}
 		}
 		// if  seller product is not in the cart already then add the new shopping cart 
 		else{
 			if(Auth::check()){
 				$user_id = Auth::user()->user_id;
 				$cart = new ShoppingCart;
 				$cart->sp_id = $sp_id;
 				$cart->user_id = $user_id;
 				$cart->number_of_items = $number_of_items;
 				$cart->save();
 				$result = true;
 			}
 			else{
 				$carts = session('shopping_cart');
 				if($carts==null){
 					$carts = [];
 				}
 				$new_cart = array(); 				
 				$new_cart["sp_id"] = $sp_id;
 				$new_cart["spor_id"] = null;
 				$new_cart["number_of_items"] = $number_of_items;
 				array_push($carts,$new_cart);
 				session(['shopping_cart'=>$carts]);
 				$result = true;          
 			}
 		}

 		
 		return  $result;
 	}
 	public function addSPOptionRelationInCart($spor_id,$number_of_items)   {
 		$spor = SPOptionRelation::find($spor_id);
 		$sp_id = $spor->sp_id;
 		$result = false;
 		// if seller product is already in the cart then update the cart if possible 
 		if($this->isSPOptionRelationInCart($spor_id)){
 			// update the existing cart if possible in the cart
 			// if cannot add the seller product in the cart then return false,
 			// else the code below will execute
 			if(!$this->canAddSPOptionRelationInExistingProductCart($spor_id,$number_of_items)){
 				return false;
 			}
 			if(Auth::check()){
 				$user_id = Auth::user()->user_id;
 				$cart = ShoppingCart::where('sp_id',$sp_id)->where('user_id',$user_id)->where('spor_id',$spor_id)->first();
 				$cart->sp_id = $sp_id;
 				$cart->user_id = $user_id;
 				$cart->spor_id = $spor_id;
 				$cart->number_of_items =$cart->number_of_items + $number_of_items;
 				$cart->save();
 				$result = true;
 			}
 			else{
 				$carts = array();
 				if(session('shopping_cart')!=null){
 					$carts = session('shopping_cart'); 				
 					foreach ($carts as $key => $cart) {
 						if($cart["spor_id"]==$spor_id && $cart["sp_id"]==$sp_id){
 							$carts[$key]['number_of_items'] = $carts[$key]['number_of_items'] + $number_of_items;
 						}
 					}
 				} 				
 				session(['shopping_cart'=>$carts]);
 				$result = true;          
 			}
 		}
 		// if  seller product is not in the cart already then add the new shopping cart 
 		else{
 			if(Auth::check()){
 				$user_id = Auth::user()->user_id;
 				$cart = new ShoppingCart;
 				$cart->sp_id = $sp_id;
 				$cart->user_id = $user_id;
 				$cart->spor_id = $spor_id;
 				$cart->number_of_items = $number_of_items;
 				$cart->save();
 				$result = true;
 			}
 			else{
 				$carts = session('shopping_cart');
 				if($carts==null){
 					$carts = [];
 				}
 				$new_cart = array(); 				
 				$new_cart["sp_id"] = $sp_id;
 				$new_cart["spor_id"] = $spor_id;
 				$new_cart["number_of_items"] = $number_of_items;
 				array_push($carts,$new_cart);
 				session(['shopping_cart'=>$carts]);
 				$result = true;          
 			}
 		}

 		
 		return  $result;
 	}
 	public function updateSellerProductInCart($sp_id,$number_of_items)   {
 		$result = false;
 		if($number_of_items<=0){
 			$result = $this->removeSellerProductInCart($sp_id);
 			return $result;
 		}
 		if($number_of_items>0){
	 		// if seller product is already in the cart then update the cart if possible 
	if($this->isSellerProductInCart($sp_id)){
	 			// update the existing cart if possible in the cart
	 			// if cannot add the seller product in the cart then return false,
	 			// else the code below will execute
		if(!$this->canUpdateSellerProductInExistingProductCart($sp_id,$number_of_items)){
			return false;
		}
		if(Auth::check()){
			$user_id = Auth::user()->user_id;
			$cart = ShoppingCart::where('sp_id',$sp_id)->where('user_id',$user_id)->where('spor_id',null)->first();
			$cart->sp_id = $sp_id;
			$cart->user_id = $user_id;
			$cart->spor_id = null;
			$cart->number_of_items = $number_of_items;
			$cart->save();
			$result = true;
		}
		else{
			$carts = array();
			if(session('shopping_cart')!=null){
				$carts = session('shopping_cart'); 				
				foreach ($carts as $key => $cart) {
					if($cart["spor_id"]==null && $cart["sp_id"]==$sp_id){
						$carts[$key]['number_of_items'] =  $number_of_items;
					}
				}
			} 				
			session(['shopping_cart'=>$carts]);
			$result = true;          
		}
	}

}

return  $result;
}
public function updateSPOptionRelationInCart($spor_id,$number_of_items)   {
	$spor = SPOptionRelation::find($spor_id);
	$sp_id = $spor->sp_id;
	$result = false;
	if($number_of_items<=0){
		$result = $this->removeSPOptionRelationInCart($spor_id);
		return $result;
	}	
	if($number_of_items>0){
	 	// if seller product is already in the cart then update the cart if possible 
		if($this->isSPOptionRelationInCart($spor_id)){
	 			// update the existing cart if possible in the cart
	 			// if cannot add the seller product in the cart then return false,
	 			// else the code below will execute
			if(!$this->canUpdateSPOptionRelationInExistingProductCart($spor_id,$number_of_items)){
				return false;
			}
			if(Auth::check()){
				$user_id = Auth::user()->user_id;
				$cart = ShoppingCart::where('sp_id',$sp_id)->where('user_id',$user_id)->where('spor_id',$spor_id)->first();
				$cart->sp_id = $sp_id;
				$cart->user_id = $user_id;
				$cart->spor_id = $spor_id;
				$cart->number_of_items =$number_of_items;
				$cart->save();
				$result = true;
			}
			else{
				$carts = array();
				if(session('shopping_cart')!=null){
					$carts = session('shopping_cart'); 				
					foreach ($carts as $key => $cart) {
						if($cart["spor_id"]==$spor_id && $cart["sp_id"]==$sp_id){
							$carts[$key]['number_of_items'] = $number_of_items;
						}
					}
				} 				
				session(['shopping_cart'=>$carts]);
				$result = true;          
			}
		}
	}
	return  $result;
}
public function removeSellerProductInCart($sp_id)    {

	if(!$this->isSellerProductInCart($sp_id)){
		return true;
	}
	$result = false;        
	if(Auth::check()){
		$user_id = Auth::user()->user_id;
		$carts = ShoppingCart::where('user_id',$user_id)->where('spor_id',null)->where('sp_id',$sp_id)->get();
		foreach ($carts as $cart) {
			$cart->delete();
		}
		$result = true;
	}
	else{
		$carts = array();
		$new_carts = array();
		$is_in_cart = false;
		if(session('shopping_cart')!=null){
			$carts = session('shopping_cart'); 				
			foreach ($carts as $key => $cart) {
				if($cart["spor_id"]==null && $cart["sp_id"]==$sp_id){

				}
				else{
            			// put those values in new array where the matching spor id is not  present
					array_push($new_carts,$cart);
				}	
			}
		}
		session(['shopping_cart'=>$new_carts]) ;			
		$result = true;          
	}
	return  $result;
}
public function removeSPOptionRelationInCart($spor_id)    {
	$spor = SPOptionRelation::find($spor_id);
	$sp_id = $spor->sp_id;
	if(!$this->isSPOptionRelationInCart($spor_id)){
		return true;
	}
	$result = false;        
	if(Auth::check()){
		$user_id = Auth::user()->user_id;
		$carts = ShoppingCart::where('user_id',$user_id)->where('spor_id',$spor_id)->where('sp_id',$sp_id)->get();
		foreach ($carts as $cart) {
			$cart->delete();
		}
		$result = true;
	}
	else{
		$carts = array();
		$new_carts = array();
		$is_in_cart = false;
		if(session('shopping_cart')!=null){
			$carts = session('shopping_cart'); 				
			foreach ($carts as $key => $cart) {
				if($cart["spor_id"]==$spor_id && $cart["sp_id"]==$sp_id){

				}
				else{
            			// put those values in new array where the matching spor id is not  present
					array_push($new_carts,$cart);
				}	
			}
		}
		session(['shopping_cart'=>$new_carts]) ;			
		$result = true;          
	}
	return  $result;
}

/*Total price of the items in the cart*/
public function getTotalPrice()
{
 	// SPPriceHistoryHelper for getting the price of the seller product in the current currency
	$price_h = new SPPriceHistoryHelper; 
	$tot_price = 0;
	if (Auth::check()) {
		$carts = ShoppingCart::where('user_id',Auth::id())->get();
		foreach ($carts as $key => $cart) {
			$sp_id = $cart->sp_id;
			$number_of_items = $cart->number_of_items;
			$price = $price_h->getCurrentCurrencyPriceOfSellerProduct($sp_id)*$number_of_items;
			$tot_price +=$price;
		}
	}
	else{
		$carts = session('shopping_cart');
		if($carts==null){
			$carts = array();
		}
		foreach ($carts as $key => $cart) {
			$sp_id = $cart['sp_id'];
			$number_of_items = $cart['number_of_items'];
			$price = $price_h->getCurrentCurrencyPriceOfSellerProduct($sp_id)*$number_of_items;
			$tot_price +=$price;
		} 
	}
	return $tot_price;
}
/*Total number of the items in the cart*/
public function getTotalNumberOfItems()
{
	$tot_num = 0;
	if (Auth::check()) {
		$carts = ShoppingCart::where('user_id',Auth::id())->get();
		foreach ($carts as $key => $cart) {
			$tot_num +=$cart->number_of_items;;
		}
	}
	else{
		$carts = session('shopping_cart');
		if($carts==null){
			$carts = array();
		}
		foreach ($carts as $key => $cart) {
			$tot_num +=$cart['number_of_items'];
		} 
	}
	return $tot_num;
}
}

