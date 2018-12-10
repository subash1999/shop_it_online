<?php 
 /**
  * 
  */

 namespace App\Http\Helpers;

 use App\CategoryProductRelation;
 use App\SellerProduct;

 use App\Category;

 class CategoryHelper	
 {
 	private $product_category_location = array();
 	private $product_category_id_location = array();
 	public function category_print()
 	{
 		$categories = Category::where('parent_cate','=',null)->get();
 		foreach ($categories as $category) {

 			getSubCategory($category->cate_id);

 		}	
 	}
// finds if the category has a sub category and if it has a sub category it goes deeper by checking each and finding sub category recurssively
 	public function getSubCategory($id)
 	{
 		$category = Category::find($id); 
 		$category_name = $category->cate_name;
 		if(!hasSubCategory($category->cate_id)){
 			$category->cate_name;
 		}
 		if(hasSubCategory($category->cate_id)){    
 			$sub_categories = Category::where('parent_cate','=',$category->cate_id)->get();
 			foreach ($sub_categories as $key => $sub_category) {
 				getSubCategory($sub_category->cate_id);        
 			}     
 			
 		}   
 		
 	}

 	public function hasSubCategory($cate_id)
 	{
 		$category = Category::where('parent_cate','=',$cate_id)->count();
 		if($category>0){
 			return true;
 		}        
 		else{
 			return false;
 		}
 	}
 	// finding if the category has a parent
 	public function hasParentCategory($cate_id)
 	{
 		$category = Category::where('parent_cate','!=',null)->find($cate_id);
 		if(count($category)>0){
 			return true;
 		}        
 		else{
 			return false;
 		}
 	}
 	// call throught the getCategoryLoationOfProduct 
 	// get parent category
 	private function getCategoryLocation($cate_id)
 	{
 		$category = Category::find($cate_id);
 		array_unshift($this->product_category_location,$category->cate_name);
 		if($this->hasParentCategory($category->cate_id)){
 			$this->getCategoryLocation($category->parent_cate);
 		}

 	}
 	public function getCategoryLocationOfSellerProduct($sp_id){
 		// here sp stands for seller product i.e product of a individual seller  
 		$sp = SellerProduct::with('product')->find($sp_id);    
 		return $this->getCategoryLocationOfProduct($sp->product->p_id);
 	}
/*get the $p_id as the parameter 
returns the array as the location
i.e ['Electronics','Mobile','Samsung']
so the location is Electronics/Mobile/Samsung*/
public function getCategoryLocationOfProduct($p_id)
{
	$cate_reln = CategoryProductRelation::with('category')->where('p_id', '=',$p_id)->get()->first();
	$this->product_category_location = array();
 		// return $cate_reln;
	$this->getCategoryLocation($cate_reln->cate_id);
	return $this->product_category_location;
 		// array_push($product_category_location,$cate_reln->category->cate_name);
}

 	// call throught the getCategoryLoationOfProduct 
 	// get parent category
private function getCategoryIdLocation($cate_id)
{
	$category = Category::find($cate_id);
	array_unshift($this->product_category_id_location,$category->cate_id);
	if($this->hasParentCategory($category->cate_id)){
		$this->getCategoryIdLocation($category->parent_cate);
	}

}
/*get the $p_id as the parameter 
returns the array as the location
i.e ['Electronics','Mobile','Samsung']
so the location is Electronics/Mobile/Samsung*/
public function getCategoryIdLocationOfProduct($p_id)
{
	$cate_reln = CategoryProductRelation::with('category')->where('p_id', '=',$p_id)->get()->first();
	$this->product_category_id_location = array();
 		// return $cate_reln;
	$this->getCategoryIdLocation($cate_reln->cate_id);
	return $this->product_category_id_location;
 		// array_push($product_category_location,$cate_reln->category->cate_name);
}

public function getCategoryIdLocationOfSellerProduct($sp_id){
 		// here sp stands for seller product i.e product of a individual seller  
	$sp = SellerProduct::with('product')->find($sp_id);    
	return $this->getCategoryIdLocationOfProduct($sp->product->p_id);
}
}
?>