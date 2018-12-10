<?php

namespace App\Http\Controllers\All_User;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Helpers\CurrencyHelper;
use App\ProductClick;
use App\SellerProduct;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Validator;
use App\Seller;

class AllProductsController extends Controller
{
	public function index(Request $request)
	{	
		// checking if the search keyword is for the shop
		// if it is for the shop $request->shop_keyword will not be null;
		if($request->shop_keyword!=null&&$request->shop_keyword!=""){
			$request->keyword = $request->shop_keyword;
		}
		// dd($request->all());
		$c_h = new CurrencyHelper;
		// getting the selcted_seller
		$selected_seller_id = null;
		$selected_seller = null;
		if($request->seller_id!=null){
			$selected_seller = Seller::find($request->seller_id);
			if($selected_seller==null){
				abort(404,"The seller you choose can not be found");
			}
		}
		$old_filter=[];
		$old_filter['min'] = $request->min;		
		$old_filter['max'] = $request->max;
		$old_filter['category'] = $request->category;
		$old_filter['seller_id'] = $request->seller_id;
		$old_filter['keyword'] = $request->keyword;
		$old_filter['shop_keyword'] = $request->shop_keyword;
		$old_filter['category_names'] = [];
		$curr_symb = $c_h->getCurrentCurrencySymbol();
		$rec_view = $this->recentlyViewed();
		$cate_list = $this->getMainCategoryList();
		// getting the categories in which search was conducted
		if ($request->category!=null && $request->category!="") {
			foreach ($request->category as $cate_id) {
				if($cate_id==null||$cate_id==''){
					break;
				}
				$cate = Category::find($cate_id);
				if($cate!=null){
					array_push($old_filter['category_names'],$cate->cate_name);	
				}			
			}
		}

		// get the sellers list
		$sellers = $this->getSellersList();
		$results = $this->search($request);
		// paginate the results
		/*Paginate the cart items*/
     	// Get current page form url e.x. &page=1
		$currentPage = LengthAwarePaginator::resolveCurrentPage();

          // Create a new Laravel collection from the array data
		$itemCollection = collect($results);

          // Define how many items we want to be visible in each page
		$perPage = 15;

          // Slice the collection to get the items to display in current page
		$currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

          // Create our paginator and pass it to the view
		$paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

          // set url path for generted links
		$paginatedItems->setPath($request->url());
		return view('public/pages/all_products/all_products',['rec_view'=>$rec_view,'curr_symb'=>$curr_symb,'cate_list'=>$cate_list,'results'=>$paginatedItems,'sellers'=>$sellers,'selected_seller'=>$selected_seller,'old_filter'=>$old_filter]);
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
	public function recentlyViewed()
	{
		$items = [];
		$pcs = ProductClick::inRandomOrder()->with('sellerProduct.SPPhotos')->latest()->get();
		$i=0;
		foreach ($pcs as $pc) {
			if($i<6){
				$item =[];
				$item['sp_id'] = $pc->SellerProduct->sp_id;
				$item['name'] = $pc->SellerProduct->sp_name1;
				$item['price'] = $pc->SellerProduct->getCurrentCurrencyPriceOfSellerProduct();
				$item['photo'] = $pc->SellerProduct->SPPhotos[0]->photo;
				$item['photo'] = asset('storage/uploads/'.$item["photo"]);
				$item["new"] = false;
				if(Carbon::now()->diffInDays($pc->SellerProduct->created_at)<5){
					$item["new"] = true;                
				}
				array_push($items,$item);
			}

		}
		$i = 0;
		if($pcs==null||count($pcs)!=5){
			$sps = SellerProduct::with('SPPhotos')->latest()->limit(5-count($pcs)); 
			foreach ($sps as $sp) {
				if($i<6){
					$item =[];
					$item['sp_id'] = $sp->sp_id;
					$item['name'] = $sp->sp_name1;
					$item['price'] = $sp->getCurrentCurrencyPriceOfSellerProduct();
					$item['photo'] = $sp->SPPhotos[0]->photo;
					$item['photo'] = asset('storage/uploads/'.$item["photo"]);
					$item["new"] = false;
					if(Carbon::now()->diffInDays($sp->SellerProduct->created_at)<5){
						$item["new"] = true;
					}
					array_push($items,$item);
				}
			}
		}
		return $items;
	}
	public function search(Request $request)
	{
		// server side validation checker 
		$validator = $request->validate([
			'category.*'=>'nullable|exists:categories,cate_id',
			'min_price' =>'min:0|nullable|number',
			'max_price' =>'nullable|number',
			'keyword'=>'nullable|string',
			'seller_id'=>'nullable|',
		]);
		$valid = $this->checkFilterValidity($request->category,$request->min,$request->max);
		$request->category  =$valid['categories'];
		$request->min = $valid['min_price'];
		$request->max = $valid['max_price'];
		$valid_sp1_id = [];
		$valid_sp2_id = [];
		$valid_sp3_id = [];
		$valid_sp4_id = [];
		$valid_sp5_id = [];
		$sps = SellerProduct::all();
		$i=0;		
		foreach($sps as $key=>$sp){
			$i++;
			$cate_belong = $sp->CategoryListToWhichItBelong();
			$is_in_cate = false;
			$is_all_null =true ;
			foreach ($request->category as $cate_id) {
				if($cate_id==null||$cate_id==""){
					$is_all_null = true;
				}
				else{
					$is_all_null = false;
				}
				if(in_array($cate_id,$cate_belong)){
					$is_in_cate = true;	
					break;		
				}
			}
			if($is_all_null){
				$is_in_cate = true;
			}
			if($sp->isOfPriceRange($request->min,$request->max)&&$is_in_cate){
				if($this->search_partial($sp->sp_name1,$request->keyword)){
					array_push($valid_sp1_id,$sp->sp_id);
					continue;
				}
				else if($this->search_partial($sp->sp_name2,$request->keyword)){
					array_push($valid_sp2_id,$sp->sp_id);
					continue;
				}
				else if($this->search_partial($sp->sp_name3,$request->keyword)){
					array_push($valid_sp3_id,$sp->sp_id);
					continue;
				}
				else if($this->search_partial($sp->sp_name4,$request->keyword)){
					array_push($valid_sp4_id,$sp->sp_id);
					continue;
				}
				else if($this->search_partial($sp->sp_name5,$request->keyword)){
					array_push($valid_sp5_id,$sp->sp_id);
					continue;
				}
			}		
			
		}

		$valid_sp_id = array_merge($valid_sp1_id,$valid_sp2_id,$valid_sp3_id,$valid_sp4_id,$valid_sp5_id);
		// if seller id is given
		if($request->seller_id!=null&&$request->seller_id!=""){
			$sps = SellerProduct::with('seller')->find($valid_sp_id);
			$temp_id = [];
			foreach ($sps as $sp) {
				if($sp->Seller->seller_id==$request->seller_id){
					array_push($temp_id,$sp->sp_id);
				}				 
			}
			$valid_sp_id = $temp_id;
		}
		// getting the seller products
		$sps  = SellerProduct::with('SPPhotos')->find($valid_sp_id);
		
		if($sps==null){
			$sps = [];
		}
		$results = [];
		foreach ($sps as $sp) {
			$result = [];
			// dd($sp);
			$result['photo'] = $sp->SPPhotos[0]->photo;
			$result['sp_id'] = $sp->sp_id;
			$result['photo'] = asset('storage/uploads/'.$result["photo"]);
			$result['is_new'] = false;
			if(Carbon::now()->diffInDays($sp->created_at)<5){
				$result["is_new"] = true;                
			}
			$result['price'] = $sp->getCurrentCurrencyPriceOfSellerProduct();
			$result['name'] = $sp->sp_name1;
			array_push($results, $result);
		}
		// dd($results);
		return $results;
	}
	public function search_partial($word, $keyword) {		
		if ($keyword!=null) {
			

			if($keyword==""||$keyword==null){
				return true;
			}
			if (strpos(strtolower($word),strtolower($keyword)) !== FALSE){
				return true;
			}
		}
		else{
			return true;
		}

		return false;
	}
	// all the multiple inputs like categories are in the form of array
	public function checkFilterValidity($categories,$min_price,$max_price){
		if(!is_numeric($min_price)){
			$min_price = 0;
		}
		if(!is_numeric($max_price)){
			$max_price = INF;
		}
		$selected_categories = [];	
		if($categories==null){
			$categories = [];
		}	
		foreach ($categories as $key => $value) {
			if (empty($value)) {
				$value=null;
			}
			if(!is_numeric($value)){
				$value = null;
			}
			array_push($selected_categories, $value);
		}
		$valid_checks['categories'] = $selected_categories;
		$valid_checks['min_price'] = $min_price;
		$valid_checks['max_price']= $max_price;
		return $valid_checks; 
		// now for categories id value;

	}
	public function getSellersList()
	{	
		$sellers = Seller::all();
		if($sellers==null){
			$sellers = [];
		}
		return $sellers;
	}
	
}
