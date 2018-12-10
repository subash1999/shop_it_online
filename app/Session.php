<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    use SoftDeletes;
    protected $primaryKey='session_id';
    protected $dates = ['deleted_at'];
    protected $table = 'sessions';

    /**
     * Session belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = user_id)
    	return $this->belongsTo('App\User','user_id','user_id');
    }

    /**
     * Session belongs to Guest.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guest()
    {
    	// belongsTo(RelatedModel, foreignKey = guest_id, keyOnRelatedModel = guest_id)
    	return $this->belongsTo('App\Guest','guest_id','guest_id');
    }
}
