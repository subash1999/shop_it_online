<?php 
 /**
  * 
  */

 namespace App\Http\Helpers;

 use App\SPOptionRelation;

 use App\Wishlist;

 use App\CategoryProductRelation;
 use App\SellerProduct;
 use Auth;
 use App\Category;

 class WishlistHelper	
 {
 	public function isSPOPtionRelationInWishlist($spor_id)
 	{ 		
 		$ret = false;
 		if(Auth::check()){
 			$wishlist_count = Wishlist::with('SPOPtionRelation')->where('spor_id',$spor_id)->where('user_id',Auth::user()->user_id)->count();
 			if($wishlist_count>0){
 				$ret = true;
 			}
 		}
 		else{
 			$wishlists = session('wishlist');
 			
 			if($wishlists!=null){

 				if(is_array($wishlists)){
 					foreach ($wishlists as $wishlist) {

 						if($wishlist["spor_id"]==$spor_id){

 							$ret = true;
 						}
 					}
 					
 				}
 			}
 			
 		}
 		return $ret;
 	}

 	public function isSellerProductInWishlist($sp_id)
 	{
 		// for the sp and with no option only 
 		// only the product with no option can be added to the wishlist for spor =0
 		// so to check the seller product in wishlist we have to make sure it has no option
 	
 		$ret = false;
 		if(Auth::check()){
 			$wishlist_count = Wishlist::where('sp_id',$sp_id)->where('spor_id',null)->where('user_id',Auth::user()->user_id)->count();
                  if($wishlist_count>0){
 				$ret = true;
 			}
 		}
 		else{
 			$wishlists = session('wishlist');
 			if($wishlists!=null){
 				if(is_array($wishlists)){
 					foreach ($wishlists as $wishlist) {
 						if($wishlist["sp_id"]===$sp_id && $wishlist['spor_id']==null){
 							$ret = true;
 						}
 					}
 					
 				}
 			}
 			
 		}
 		return $ret; 		
 		
 	}
 	public function addSellerProductInWishlist($sp_id)    {

 		$w_h = new WishlistHelper;
 		if($w_h->isSellerProductInWishlist($sp_id)){
 			return true;
 		}
 		$result = false;        
 		if(Auth::check()){
 			$user_id = Auth::user()->user_id;
 			$wl = new Wishlist;
 			$wl->sp_id = $sp_id;
 			$wl->user_id = $user_id;
 			$wl->save();
 			$result = true;
 		}
 		else{
 			$wishlists = array();
 			$is_already_in_wishlist = false;
 			if(session('wishlist')!=null){
 				$wishlists = session('wishlist'); 				
 				foreach ($wishlists as $key => $wishlist) {
            		if($wishlist["spor_id"]==null && $wishlist["sp_id"]==$sp_id){
            			$is_already_in_wishlist = true;
            		}
 				}
 			}
 			if(!$is_already_in_wishlist){
 			$new_wishlist["sp_id"] = $sp_id;
 			$new_wishlist["spor_id"] = null;
 			array_push($wishlists,$new_wishlist);
 			session(['wishlist'=>$wishlists]);
 			}
 			$result = true;          
 		}
 		return  $result;
 	}

 	public function removeSellerProductInWishlist($sp_id)    {

 		$w_h = new WishlistHelper;
 		if(!$w_h->isSellerProductInWishlist($sp_id)){
 			return true;
 		}
 		$result = false;        
 		if(Auth::check()){
 			$user_id = Auth::user()->user_id;
 			$wls = Wishlist::where('user_id',$user_id)->where('spor_id',null)->where('sp_id',$sp_id)->get();
 			foreach ($wls as $wl) {
 				$wl->delete();
 			}
 			$result = true;
 		}
 		else{
 			$wishlists = array();
 			$new_wishlists = array();
 			$is_in_wishlist = false;
 			if(session('wishlist')!=null){
 				$wishlists = session('wishlist'); 				
 				foreach ($wishlists as $key => $wishlist) {
            		if($wishlist["spor_id"]==null && $wishlist["sp_id"]==$sp_id){
            			
            		}
            		else{
            			// put those values in new array where the matching spor id is not  present
            			array_push($new_wishlists,$wishlist);
            		}	
 				}
 			}
 			session(['wishlist'=>$new_wishlists]) ;			
 			$result = true;          
 		}
 		return  $result;
 	}
 	public function addSPOptionRelationInWishlist($spor_id)    {

 		$w_h = new WishlistHelper;
 		if($w_h->isSPOPtionRelationInWishlist($spor_id)){
 			return true;
 		}
 		$result = false;        
 		$spor = SPOptionRelation::find($spor_id);
 		$sp_id = $spor->sp_id;
 		if(Auth::check()){
 			$user_id = Auth::user()->user_id;
 			$wl = new Wishlist;
 			$wl->spor_id = $spor_id;
 			$wl->sp_id = $sp_id;
 			$wl->user_id = $user_id;
 			$wl->save();
 			$result = true;
 		}
 		else{
 			$wishlists = array();
 			$is_already_in_wishlist = false;
 			if(session('wishlist')!=null){
 				$wishlists = session('wishlist'); 				
 				foreach ($wishlists as $key => $wishlist) {
            		if($wishlist["spor_id"]==$spor_id && $wishlist["sp_id"]==$sp_id){
            			$is_already_in_wishlist = true;
            		}
 				}
 			}
 			if(!$is_already_in_wishlist){
 			$new_wishlist["sp_id"] = $sp_id;
 			$new_wishlist["spor_id"] = $spor_id;
 			array_push($wishlists,$new_wishlist);
 			session(['wishlist'=>$wishlists]);
 			}
 			$result = true;          
 		}
 		return  $result;
 	}

 	public function removeSPOptionRelationInWishlist($spor_id)    {

 		$w_h = new WishlistHelper;
 		if(!$w_h->isSPOPtionRelationInWishlist($spor_id)){
 			return true;
 		}
 		$result = false;        
 		$spor = SPOptionRelation::find($spor_id);
 		$sp_id = $spor->sp_id;
 		if(Auth::check()){
 			$user_id = Auth::user()->user_id;
 			$wls = Wishlist::where('user_id',$user_id)->where('spor_id',$spor_id)->where('sp_id',$sp_id)->get();
 			foreach ($wls as $wl) {
 				$wl->delete();
 			}
 			$result = true;
 		}
 		else{
 			$wishlists = array();
 			$new_wishlists = array();
 			$is_in_wishlist = false;
 			if(session('wishlist')!=null){
 				$wishlists = session('wishlist'); 				
 				foreach ($wishlists as $key => $wishlist) {
            		if($wishlist["spor_id"]==$spor_id && $wishlist["sp_id"]==$sp_id){
            			
            		}
            		else{
            			// put those values in new array where the matching spor id is not  present
            			array_push($new_wishlists,$wishlist);
            		}	
 				}
 			}
 			session(['wishlist'=>$new_wishlists]) ;			
 			$result = true;          
 		}
 		return  $result;
 	}
     /*Total number of the items in the wishlist*/
      public function getTotalNumberOfItems()
      {
            $tot_num = 0;
            if (Auth::check()) {
                  $wishlists = Wishlist::where('user_id',Auth::id())->get();
                  foreach ($wishlists as $key => $wishlist) {
                        $tot_num +=1;
                  }
                  // dd("a");
            }
            else{
                  $wishlists = session('wishlist');
                  if($wishlists==null){
                        $wishlists = array();
                  }
                  $tot_num = count($wishlists); 
                  // dd("b");
            }
            return $tot_num;
      }
 }