<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->createUsers();
        $this->createAdmin();
        $this->createSeller();
    }
    public function createUsers(){
        $users = array(
            "Subash"=>"123456",
            "Sunam"=>"1sdfsd",
            "Khina"=>"fdsf43",
            "Dipesh"=>"ashfdt4e43",
            "Oskar"=>"654hsf",
            "Angel"=>"gfhfd",
            "Enesh"=>"ds65fghgfd",
            "Ichhita"=>"34s756fghfg4",
            "Lure Don"=>"6s66dfa4222",
            "Deepa"=>"324gfhterre",
            "Pragya"=>"gfft5e",
            "Sushan"=>"sdfsdrew",
            "Nischal"=>"hdfg4fh6454s",
            "Ashmita"=>"fds54",
            "Nishan"=>"45gers3",
            "Urmila"=>"3242dgg",
            "jaya"=>"gfddfgf",
            "s"=>"s",
            "su"=>"su",
            "Rekha"=>"fgsdtregds",
            "Tirtha" => "gdtergfger2r43",
            "Subash4455"=>"Subash123",
            "subash1999"=>"Subash123",
            "Angelina" =>"Angedarling", 
        );

        foreach($users as $x => $x_value) {
            $user = new App\User;
            $user->username = $x;
            $user->password = Hash::make($x_value);
            $user->email = $x."@gmail.com";
            $user->save();
                // DB::table('users')->insert([
                //  'username' => $x,
                //  'password' => bcrypt($x_value),
                // ]);              
        }

    }
    public function createAdmin()
    {
        $user = new App\User;
        $user->username = 'iamadmin';
        $user->password ='123456';
        $user->email = 'iamadmin@gmail.com';
        $user->save();

    // getting the admin user type 
        $ut = App\UserType::where('type','admin')->first();

    // Now user type relation for the admin
        $user_type_relation = new App\UserTypeRelation;
        $user_type_relation->ut_id = $ut->ut_id;
        $user_type_relation->user_id = $user->user_id;
        $user_type_relation->save();    

    // adding the admin data
        $admin = new App\Admin;
        $admin->user_id = $user->user_id;
        $admin->first_name  = "IamAdmin";
        $admin->last_name = "Ad_l_name";
        $admin->dob = "1999-03-03";
        $admin->gender = "Male";
        $admin->email1= "admin@gmail.com";
        $admin->add1= "Ramchowk,Manipur";
        $admin->phone1="9779852060980";
        $admin->city="Nawalparasi";
        $admin->country="Nepal";
        $admin->photo= "Seller_37_photo_SessionID_qiaqnRBVPLfWetBYwylp57INF7UENSBK2Qw2Cj8F_0.51510400 1539589227.jpeg";
        $admin->save();
    }
    public function createSeller(){
        $seller_user = new App\User;
        $seller_user->username = 'iamseller';
        $seller_user->password = '123456';
        $seller_user->email = 'iamseller@gmail.com';
        $seller_user->save();

        // getting the admin user type 
        $ut = App\UserType::where('type','seller')->first();

        // Now user type relation for the admin
        $user_type_relation = new App\UserTypeRelation;
        $user_type_relation->ut_id = $ut->ut_id;
        $user_type_relation->user_id = $seller_user->user_id;
        $user_type_relation->save();   

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
