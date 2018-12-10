<?php
namespace App\Http\Helpers\Admin;

use App\Admin;
use App\Http\Helpers\UserHelper;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * 
 */
class AdminHelper 
{
  
  public function getLoginedAdmin()        
  {
    $user_helper = new UserHelper;
    $random_user = User::inRandomOrder()->ofType('admin')->first();
      //we have to check if the user is logined and if it is an admin
    $admin_name = "Not Logined : Admin";
    $created_at = "Developing 1970/01/01";
    $user_id = $random_user->user_id;
    $admin_id = Admin::where('user_id','=',$user_id)->get();
    if (Auth::check()) {
      if($user_helper->isUserAdmin(Auth::user()->user_id)){
       $admin_name = Auth::user()->username;
       $created_at = Auth::user()->created_at;
       $user_id = Auth::user()->user_id;
       $admin_id = Admin::where('user_id','=',$user_id)->get();        
     }           

   }
   $user = ["admin_name"=>$admin_name,"created_at"=>$created_at,'user_id'=>$user_id,'admin_id'=>$admin_id];
   return ($user);

 }
/**
 * takes the table name as the parameter and 
 * returns the columns name user_id as "User Id"
 */
//get column name of a table
public function getColumnNames($table){
  $columns = DB::connection()->getSchemaBuilder()->getColumnListing($table);
  $length = count($columns);
  for ($i=0; $i <$length ; $i++) { 
    $splitName = explode('_', $columns[$i]);
    $value="";
    foreach ($splitName as $split) {
      $value = $value ." ". ucfirst($split);
    }
    $columns[$i] = trim($value);
  }
  return $columns;
}
public function convertTableColNamesToDBColNames($table_columns)
{
  $length = count($table_columns);
  $columns = [];
  for ($i=0; $i <$length ; $i++) { 
    $splitName = explode(' ',trim($table_columns[$i]));
    $value ='' ;
    $j=0;
    foreach ($splitName as $split) {
      if($j!=0){
        $value = $value ."_". strtolower($split);
      }
      else{
       $value =  strtolower($split);
     }
     $j++;
   }      
   array_push($columns,$value);
 }

 return $columns;
}
}
