<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    use SoftDeletes;
    protected $primaryKey='ut_id';
    protected $dates = ['deleted_at'];
    protected $table = 'user_types';

    /**
     * UserType has many UserTypeRelation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userTypeRelations()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = userType_id, localKey = id)
    	return $this->hasMany('App\UserTypeRelation','ut_id','ut_id');
    }

    /**
     * UserType has many UserTypePermissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userTypePermissions()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = userType_id, localKey = id)
        return $this->hasMany(UserTypePermission::class,'ut_id','ut_id');
    }
    
   
}
