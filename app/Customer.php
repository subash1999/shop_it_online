<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{
	use SoftDeletes;
    protected $primaryKey='cus_id';
    protected $dates = ['deleted_at','dob'];
    protected $table = 'customers';

    public function user(){
    	return $this->hasOne('App\User','user_id','user_id');
    }

   

   
}
