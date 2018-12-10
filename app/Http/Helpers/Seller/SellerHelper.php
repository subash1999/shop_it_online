<?php 
/**
 * 
 */

namespace App\Http\Helpers\Seller;
use App\Http\Helpers\UserHelper;
use App\Seller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerHelper
{

    public function getLoginedSeller() 
    {
        $user_helper = new UserHelper;
        $random_user = User::inRandomOrder()->ofType('seller')->first();
        $random_user = null;
        //we have to check if the user is logined and if it is an admin
        $seller_name = "Not Logined : Seller";
        $created_at = "Developing 1970/01/01";
        $user_id = "1";
        $seller = Seller::where('user_id','=',$user_id)->first(); 
        $seller_id = "1";
        if($seller!=null){  
        $seller_id = $seller->seller_id;
        } 
        if (Auth::check()) {
            if($user_helper->isUserSeller(Auth::user()->user_id)){
               $seller_name = Auth::user()->username;
               $created_at = Auth::user()->created_at;
               $user_id = Auth::user()->user_id;
               $seller = Seller::where('user_id','=',$user_id)->first();       
               $seller_id = $seller->seller_id;         
           }           

       }
       $user = ["seller_name"=>$seller_name,"created_at"=>$created_at,'user_id'=>$user_id,'seller_id'=>$seller_id];

       return ($user);

   }

}
?>