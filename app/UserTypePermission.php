<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTypePermission extends Model
{
    use SoftDeletes;
    protected $primaryKey='ut_permission_id';
    protected $dates = ['deleted_at'];
    protected $table = 'user_type_permissions';

    /**
     * UserTypePermission belongs to UserType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userType()
    {
    	// belongsTo(RelatedModel, foreignKey = ut_id, keyOnRelatedModel = id)
    	return $this->belongsTo(UserType::class,'ut_id','ut_id');
    }
}
