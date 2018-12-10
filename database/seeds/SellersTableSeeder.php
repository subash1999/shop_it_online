<?php

use App\Seller;
use App\User;
use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$seller_users = User::ofType('seller')->get();
    	foreach ($seller_users as $key => $seller_user) {
    		$seller = new Seller;
    		$seller->user_id = $seller_user->user_id;
    		$seller->first_name = $seller_user->username;
    		$seller->last_name = $seller_user->username;
    		$seller->gender = "Male";
    		$seller->company_name = "{$seller_user->username} Company Name";
    		$seller->email1 = $seller_user->email;
    		$seller->add1 = "{$seller_user->username} has a address ";
    		$seller->phone1 = "Phone of {$seller_user->username}";
    		$seller->city = "City of a {$seller_user->username} ";
    		$seller->country = "Country of a {$seller_user->username} ";
    		$seller->postal_code = "0044";    		
    		$seller->photo = "Seller Photo {$seller_user->username}";

    		$seller->identity = "Seller Identity {$seller_user->username}";

    		$seller->cover_photo = "Cover Photo {$seller_user->username}";

    		$seller->certificate = "Certificate Photo {$seller_user->username}";
        // uncomment location only after the map is included in the form
        // $seller->location = $request->location;
    		$seller->phone1_verify = "YES";
    		$seller->phone2_verify = "YES";
    		$seller->photo_verify = "YES";
    		$seller->save();
        //user verify to NO so that the user won't be deleted in certain period
    		$user = User::find($seller_user->user_id);
    		$user->user_verify = "NO";
    		$user->save();        	
    	}
    }
}
