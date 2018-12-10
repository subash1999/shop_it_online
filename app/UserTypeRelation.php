<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTypeRelation extends Model
{
    use SoftDeletes;
    protected $primaryKey='utr_id';
    protected $dates = ['deleted_at'];
    protected $table = 'user_type_relations';

    /**
     * UserTypeRelation belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
    	return $this->belongsTo('App\User','user_id','user_id');
    }
    /**
     * UserTypeRelation belongs to UserType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userType()
    {
    	// belongsTo(RelatedModel, foreignKey = userType_id, keyOnRelatedModel = id)
    	return $this->belongsTo('App\UserType','ut_id','ut_id');
    }

}
