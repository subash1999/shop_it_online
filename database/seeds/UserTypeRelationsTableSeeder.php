<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTypeRelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user_types = App\UserType::all();
        $ut_ids = [];
    	foreach ($user_types as $user_type) {
            array_push($ut_ids,$user_type->ut_id);
        }
    	$user = App\User::all();
    	for ($i=1; $i <= count($user) ; $i++) { 
    		if (User::where('user_id', '=', $i)->exists()) {
    			$user_type_relation = new App\UserTypeRelation;
    			$user_type_relation->ut_id = $ut_ids[($i-1)%count($user_types) ];
    			$user_type_relation->user_id = $user[$i-1]->user_id;
    			$user_type_relation->save();	
    		}
    	}
    }
}
