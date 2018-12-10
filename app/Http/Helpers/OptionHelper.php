<?php 
namespace App\Http\Helpers;
use App\Http\Helpers\UserHelper;
use App\SPOptionRelation;
use App\Seller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OptionHelper
{
	// it returns the option group with the first letter capital and the same name of option group as a same
	public function getOptionGroupsOfSellerProduct($sp_id)
	{
		//options of a product
		$sp_options = SPOptionRelation::with('option.optionGroup')->where('sp_id','=',$sp_id)->get();
		$option_groups = [];
		foreach ($sp_options as $key => $sp_option) {
			$og = ucfirst($sp_option->option->optionGroup->option_g_name);
            // dd($og);
			if(!array_has($option_groups,$og)){
				$option_groups[$og]=array();
			}
		}
	}
	// it returns the option group with the first letter capital and the same name of option group as a same
	public function getOptionGroupIdsOfSellerProduct($sp_id)
	{
		//options of a product
		$sp_options = SPOptionRelation::with('option.optionGroup')->where('sp_id','=',$sp_id)->get();
		$option_groups = [];
		foreach ($sp_options as $key => $sp_option) {
			$og = ucfirst($sp_option->option->optionGroup->option_g_id);
            // dd($og);
			if(!array_has($option_groups,$og)){
				$option_groups[$og]=array();
			}
		}
	}
	public function optionsOfSellerProductInOptionGroup($sp_id,$option_g_id)
	{
		//options of a product
		$sp_options = SPOptionRelation::with('option.optionGroup')->where('sp_id','=',$sp_id)->get();
		$sp_og = [];
		foreach ($sp_options as $key => $sp_option) {
			if($sp_option->option->option_g_id == $option_g_id){
				array_push($sp_og,$sp_option);
			}
		}
		$options = [];
		foreach ($sp_og as $key => $sp_option) {
			$option =$sp_option->option;
			if(!array_has($options,$option)){
				array_push($options,$option);
			}
		}
		return ($options);
	}

// output of function below is like this

// {"12":
// 	{	"option_g_name":"Color",
// 		"0":{"spor_id":5,
// 			"option_id":5,
// 			"option_name":"Silver",
// 			"photo":"option_photo_SessionID_vSx4YO2eFdEwuxWZAKKhRDXW3xdu6BiUVYHBTZai_0.21156500 1541817336.jpg",
// 			"number_of_items":5},
// 		"1":{"spor_id":6,
// 			"option_id":6,
// 			"option_name":"Black",
// 			"photo":"option_photo_SessionID_vSx4YO2eFdEwuxWZAKKhRDXW3xdu6BiUVYHBTZai_0.57376000 1541817336.jpg",
// 			"number_of_items":5}
// 	 }
// 	}
	public function getOptionsOfASellerProduct($sp_id)
	{
		//options of a product
		$sp_options = SPOptionRelation::with('option.optionGroup')->where('sp_id','=',$sp_id)->get();
		$option_groups = [];
		foreach ($sp_options as $key => $sp_option) {
			$og = ucfirst($sp_option->option->optionGroup->option_g_id);
            // dd($og);
			if(!array_has($option_groups,$og)){
				$option_groups[$og]=array();
			}
		}
		foreach ($sp_options as $key => $sp_option) {
			$og = $sp_option->option->optionGroup->option_g_id;
			if(!array_has($option_groups,$og)){
				$option_groups[$og] = array();
			}
			$option_groups[$og]["option_g_name"] = $sp_option->option->optionGroup->option_g_name;
             // $option_groups[$og]["option"] = array();
			$option["spor_id"] = $sp_option->spor_id;
			$option["is_in_wishlist"] = $sp_option->isInWishlist();
			$option["option_id"] = $sp_option->option->option_id;
			$option["option_name"] = $sp_option->option->option_name;
			$option["photo"] = $sp_option->option->photo;
			$option["number_of_items"] = $sp_option->number_of_items;
			$option["sold"] = $sp_option->sold;
			array_push($option_groups[$og],$option);
            // dd($option_groups);
		}
		return $option_groups;
	}
}
?>