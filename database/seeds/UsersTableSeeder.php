<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        $user->password = bcrypt($x_value);
        $user->email = $x."@gmail.com";
        $user->save();
             	// DB::table('users')->insert([
    			// 	'username' => $x,
    			// 	'password' => bcrypt($x_value),
    			// ]);    			
    }
    
}
}
