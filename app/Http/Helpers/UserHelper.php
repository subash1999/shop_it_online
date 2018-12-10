<?php 
 /**
  * 
  */

 namespace App\Http\Helpers;

 use App\Currency;

 use App\User;
 use Auth;
 class UserHelper	
 {
 	
 	public function getUserType($user_id)
 	{

 		$user = User::with('userTypeRelations.userType')->find($user_id);
 		$type=[];
 		foreach ($user->userTypeRelations as $user_type_relation) {
 			array_push($type,$user_type_relation->userType->type);
 		}
 		if(count($type)==1){
 			return $type[0];
 		} 
 		// for the multitype user with all users in a list
 		else{
 			return $type;
 		}
 	}
 	public function isUserAdmin($user_id)
 	{
 		$is_admin = false;
 		$user = User::with('userTypeRelations.userType')->find($user_id);
 		if ($user!=null) {
 			foreach ($user->userTypeRelations as $user_type_relation) {
 				$type = $user_type_relation->userType->type;
 				if(strcasecmp($type,'admin')==0){
 					$is_admin = true;
 				}
 			}
 		}
 		
 		return $is_admin;
 	}
 	public function isUserSeller($user_id)
 	{
 		$is_admin = false;
 		$user = User::with('userTypeRelations.userType')->find($user_id);
 		if ($user!=null) {
 			foreach ($user->userTypeRelations as $user_type_relation) {
 				$type = $user_type_relation->userType->type;
 				if(strcasecmp($type,'seller')==0){
 					$is_admin = true;
 				}
 			}
 		}
 		return $is_admin;
 	}
 	public function isUserCustomer($user_id)
 	{
 		$is_admin = false;
 		$user = User::with('userTypeRelations.userType')->find($user_id);
 		if ($user!=null) {
 			foreach ($user->userTypeRelations as $user_type_relation) {
 				$type = $user_type_relation->userType->type;
 				if(strcasecmp($type,'customer')==0){
 					$is_admin = true;
 				}
 			}
 		}
 		return $is_admin;
 	}

 	public function getCurrentUserChoiceCurrencyId()
 	{
 		// getting the first curreny from db incase there is no user logined or no data present in session
 		$currency = Currency::first();
 		$curr_id = $currency->curr_id;
		// first check if the user is authenticated
 		if(Auth::check()){
 			// checking if  the curr_id in db is null
 			// if not null put the value else put the data
 			$temp_curr_id = Auth::user()->curr_id;
 			if($temp_curr_id!=null){
 				$curr_id = $temp_curr_id;
 			}
 		}
 		else if (session('curr_id')!=null){
 			$curr_id = session('curr_id');
 			// checking if the stored curr_id exists in db if  not set another value
 			$currency = Currency::find($curr_id);
 			if(count($currency)<=0){
 				$currency = Currency::first();
 				$curr_id = $currency->curr_id;
 			}
 			// save the currency id stored in the session to db if the curr_id in db is null
 			if(Auth::check()){
 				if( Auth::user()->curr_id==null){
 					$user = Auth::user();
 					$user->curr_id = session('curr_id');
 					$user->save();
 				}
 			}
 		}
 		// checking if the stored curr_id exists in db if  not set another value
 		$currency = Currency::find($curr_id);
 		if(count($currency)<=0){
 			$currency = Currency::first();
 			$curr_id = $currency->curr_id;
 		}
 		return $curr_id;
 	}
 	public function setCurrentUserChoiceCurrencyId($curr_id)
 	{
 		$currency = Currency::find($curr_id);
 		if(count($currency)<=0){
 			abort(403,"The currency ID is not in db while assiging curreny for user");
 		}

 		// setting the first curreny from db incase there is no user logined or no data present in session
 		session(['curr_id'=>$curr_id]);
 		// first check if the user is authenticated
 		if(Auth::check()){
 			// checking if  the curr_id in db is null
 			// if not null put the value else put the data
 			$user = Auth::user();
 			$user->curr_id = $curr_id;
 			$user->save(); 			
 		} 		
 		return $curr_id;
 	}
 	static public function getCurrentLoginedUserId()
 	{
 		if(Auth::check()){
 			return Auth::user()->user_id; 			
 		}
 		$user =  User::first();
 		return $user_id;
 	}
 }
 ?>