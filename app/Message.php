<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    protected $primaryKey='message_id';
    protected $dates = ['deleted_at'];
    protected $table = 'messages';

    /**
     * Message belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function byUser()
    {
    	// belongsTo(RelatedModel, foreignKey = from_user_id, keyOnRelatedModel = user_id)
    	return $this->belongsTo('App\User','from_user_id','user_id');
    }

    /**
     * Message belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toUser()
    {
    	// belongsTo(RelatedModel, foreignKey = to_user_id, keyOnRelatedModel = user_id)
    	return $this->belongsTo('App\User','to_user_id','user_id');
    }
}
