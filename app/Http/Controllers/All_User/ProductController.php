<?php

namespace App\Http\Controllers\All_User;

use App\CategoryProductRelation;
use App\Http\Controllers\Controller;
use App\Http\Helpers\CartHelper;
use App\Http\Helpers\CategoryHelper;
use App\Http\Helpers\CurrencyHelper;
use App\Http\Helpers\OptionHelper;
use App\Http\Helpers\SPPriceHistoryHelper;
use App\Http\Helpers\UserHelper;
use App\Http\Helpers\WishlistHelper;
use App\ProductClick;
use App\ProductRating;
use App\SPFeatureList;
use App\SPOptionRelation;
use App\SPPhoto;
use App\SellerProduct;
use App\Wishlist;
use Auth;
use Illuminate\Http\Request;
use Request as Req;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sp_id)
    {
        $c_h = new CartHelper;
        $sp = SellerProduct::with('product')->find($sp_id);
        if(count($sp)<=0){
            return abort(404,"Sorry, Product you are looking for can not be found");
        }            
        
        // for category location
        $cate_helper = new CategoryHelper;        
        $product_location =  $cate_helper->getCategoryLocationOfSellerProduct($sp_id);
        $product_category_location = '';
        foreach ($product_location as $category) {
            $product_category_location.="{$category} / ";
        }
        
        // photos of the seller product
        $photos = SPPhoto::select('photo')->where('sp_id','=',$sp_id)->get();
        // Features of the seller product
        $features  = SPFeatureList::where('sp_id','=',$sp_id)->get();
        // price of the product

        $price_helper = new SPPriceHistoryHelper;
        $price = $price_helper->getCurrentCurrencyPriceOfSellerProduct($sp_id);

        // currency_helper 
        $currency_helper = new CurrencyHelper;
        $currency_symbol =  $currency_helper->getCurrentCurrencySymbol(); 
        // dd($c_h->canAddSellerProductInExistingProductCart(19,12));
        
        $o_h = new OptionHelper;
        $option_groups = $o_h->getOptionsOfASellerProduct($sp_id);
        $w_h = new WishlistHelper;
        $is_in_wishlist = $w_h->isSellerProductInWishlist($sp_id);
        $product_rating = $this->getSPRatingOfCurrentUser($sp_id);
        $user_ratings = [];
        $user_ratings['average_rating']=$this->getAvgSPRating($sp_id);
        $user_ratings['total_number_of_rating'] = $this->getTotalNumberOfRating($sp_id);
        $product_click = new ProductClick;
        $product_click->user_id=Auth::id();
        $product_click->sp_id = $sp_id;
        $product_click->ip = Req::ip();        
        $product_click->save();

        return view('public/pages/single_product',compact('product_category_location','sp','photos','features','price','currency_symbol','option_groups','is_in_wishlist','product_rating','user_ratings'));
    }
    /*For the user Ratings*/
    public function getUserRatings($sp_id)
    {
        $user_ratings = [];
        $user_ratings['average_rating']=$this->getAvgSPRating($sp_id);
        $user_ratings['total_number_of_rating'] = $this->getTotalNumberOfRating($sp_id);
        $user_ratings['star_ratings']=$this->getStarRatingCount($sp_id);
        return  $user_ratings;
    }
    /*User Ratings*/
    public function getAvgSPRating($sp_id)
    {
        $p_rs = ProductRating::where('sp_id',$sp_id)->get();
        $tot_rating = 0;
        if ($p_rs==null) {
            $p_rs = [];
        }
        foreach ($p_rs as $key => $p_r) {
            $tot_rating += $p_r->rating/$p_r->full_score *5; 

        }
        if(count($p_rs)!=0){
            $avg = $tot_rating/count($p_rs);
        }
        else{
            $avg = 0;
        }

        return round($avg,2);
    }
    public function getTotalNumberOfRating($sp_id)
    {
        $p_rs = ProductRating::where('sp_id',$sp_id)->get();
        return count($p_rs);
    }
    public function getStarRatingCount($sp_id)
    {   $ratings = [];
        for ($i=1; $i <=5 ; $i++) { 
            $ratings[$i]["number_of_ratings"] = 0;
            $ratings[$i]["percentage_of_ratings"] = 0;
        }
        $total_ratings = $this->getTotalNumberOfRating($sp_id);

        $star=[0,0,0,0,0,0];
        // 
        $p_rs = ProductRating::where('sp_id',$sp_id)->get();
        if ($p_rs==null) {
            $p_rs = [];
        }
        foreach ($p_rs as $key => $p_r) {
            $rating = round($p_r->rating/$p_r->full_score *5,0);
            switch ($rating) {
                case 1:
                $star[1]++;
                break;
                case 2:
                $star[2]++;
                break;
                case 3:
                $star[3]++;
                break;
                case 4:
                $star[4]++;
                break;
                case 5:
                $star[5]++;
                break;
                
                default:
                    # code...
                break;
            }
        }
        for ($i=1; $i <=5 ; $i++) { 
            $ratings[$i]["number_of_ratings"] = $star[$i];
            if ($total_ratings==0) {
                $ratings[$i]["percentage_of_ratings"] = 0;
                break;
            }
            $ratings[$i]["percentage_of_ratings"] = $star[$i]/$total_ratings*100;
        }
        return $ratings;
    }
    /*For the single product rating by the user*/
    // get the ratings of a product
    // return rating in out of five
    public function getSPRatingOfCurrentUser($sp_id)
    {
        if(Auth::check()){
            $score = 0;
            $rating = ProductRating::where('sp_id',$sp_id)->where('user_id',Auth::id())->first();
            if($rating!=null){
                // make the rating to 5 stars
                $score = $rating->rating/$rating->full_score *5; 
            }
            return round($score,1);
        }
        else{
            return 0;
        }
    }
    // store the rating of a product
    // if the rating is already present update it otherwise create a new rating
    public function setSPRatingOfUser(Request $request)
    {
        $rating = $request->rating;
        $sp_id = $request->sp_id;
        $rt = "false";
        if(Auth::check()){
            $rating = ProductRating::where('sp_id',$sp_id)->where('user_id',Auth::id())->first();

            if($rating!=null){
                $rating->rating = $request->rating;
                $rating->save();
                $rt = "true";
            }
            else{
                // create a new rating row in db
                $rating = new ProductRating;
                $rating->sp_id=$sp_id;
                $rating->user_id=Auth::id();
                $rating->rating = $request->rating;
                $rating->save();
                $rt = "true";

            }
        }
        else{
            $rt = "not_logined";
        }
        return $rt;
    }
    /*  Case insensetive in_array() wrapper
    *
    *   @param mixed $needle value to seek
    *   @param array $haystack array to seek
    *
    *   @return bool
    */
    public function in_array_insensetive($needle,$haystack)
    {
        return in_array(strtolower($needle),array_map('strtolower',$haystack));
    }
    /*CART*/
    public function addSellerProductInCart(Request $request)
    {
        // dd(session('shopping_cart'));
        $sp_id = $request->sp_id;
        $number_of_items = $request->number_of_items;
        $c_h = new CartHelper;
        $ret = "false";
        // if product cannot be added due to excedding total number of available products then
        if(!$c_h->canAddSellerProductInExistingProductCart($sp_id,$number_of_items)){
            $msg = "The maximum quantity available for this product is : ".$c_h->getAvailablSellerProductCount($sp_id)."<br>"."Current cart quantity of this product is : ".$c_h->getQuantityOfSellerProductInCart($sp_id);
            return $msg;
        }
        if($c_h->addSellerProductInCart($sp_id,$number_of_items)){
            $ret = "true";
        }       
        return $ret;
    }
    public function addSPOptionRelationInCart(Request $request)
    {
        // dd(session('shopping_cart'));
        $spor_id = $request->spor_id;
        $number_of_items = $request->number_of_items;
        $c_h = new CartHelper;
        $ret = "false";
        // if product cannot be added due to excedding total number of available products then
        if(!$c_h->canAddSPOptionRelationInExistingProductCart($spor_id,$number_of_items)){
            $msg = "The maximum quantity available for this product option is : ".$c_h->getAvailableSPOptionRelationCount($spor_id)."<br>"."Current cart quantity of this product is : ".$c_h->getQuantityOfSPOptionRelationInCart($spor_id);
            return $msg;
        }
        if($c_h->addSPOptionRelationInCart($spor_id,$number_of_items)){
            $ret = "true";
        }       
        return $ret;
    }
    /*WISHLIST*/
    public function isSPOptionRelationInWishlist(Request $request)
    {
        $w_h = new WishlistHelper;
        $result = "false";
        if($w_h->isSPOPtionRelationInWishlist($request->spor_id)){
            $result = "true";
        }
        $result = trim($result);
        // return session('wishlist');
        return  $result;
    }


    // function for adding a selelr product option relation  in the wishlist
    // it checks if the seller product option relation is present in the database
    // if it is already present no addition is made and true is returned
    // if not already present then addition to database is made and true is returned
    // for any other condition false is returned
    // seller product option relation id(spor_id) is to be passed in the request
    public function addSPOptionRelationInWishlist(Request $request)    {
        $w_h = new WishlistHelper;
        $result = "false";

        if($w_h->addSPOptionRelationInWishlist($request->spor_id)){
            $result = "true";
        }

        return  $result;
    }
    public function removeSPOptionRelationInWishlist(Request $request)    {
        $w_h = new WishlistHelper;
        $result = "false";
        
        if($w_h->removeSPOptionRelationInWishlist($request->spor_id)){
            $result = "true";
        }

        return  $result;
    }

    public function addSellerProductInWishlist(Request $request)
    {
        $w_h = new WishlistHelper;
        $result = "false";
        
        if($w_h->addSellerProductInWishlist($request->sp_id)){
            $result = "true";
        }

        return  $result;
    }

    public function removeSellerProductInWishlist(Request $request)
    {
       $w_h = new WishlistHelper;
       $result = "false";

       if($w_h->removeSellerProductInWishlist($request->sp_id)){
        $result = "true";
    }

    return  $result;
}

}
