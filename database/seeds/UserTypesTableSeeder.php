<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_types = [
        	"Admin",
        	"Customer",
        	"Seller",
        ];
        foreach ($user_types as $user_type_name) {
        		$user_type = new App\UserType;
                $user_type->type = $user_type_name;
                $user_type->save();	
        }
        
    }
}
