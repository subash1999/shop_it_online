<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes;
    protected $primaryKey='feedback_id';
    protected $dates = ['deleted_at'];
    protected $table = 'feedback';

    /**
     * Feedback belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function byUser()
    {
    	// belongsTo(RelatedModel, foreignKey = from_user_id, keyOnRelatedModel = user_id)
    	return $this->belongsTo('App\User','from_user_id','user_id');
    }

    /**
     * Feedback belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toUser()
    {
    	// belongsTo(RelatedModel, foreignKey = to_user_id, keyOnRelatedModel = user_id)
    	return $this->belongsTo('App\User','to_user_id','user_id');
    }

    /**
     * Feedback has many Complains.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complains()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = feedback_id, localKey = feedback_id)
        return $this->hasMany('App\Complain','feedback_id','feedback_id');
    }
}
