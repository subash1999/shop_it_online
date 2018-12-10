<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use SoftDeletes;
    protected $primaryKey='admin_id';
    protected $dates = ['deleted_at','dob'];
    protected $table = 'admins';

    public function user(){
    	return $this->hasOne('App\User','user_id','user_id');
    }
}
