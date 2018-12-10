<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complain extends Model
{
    use SoftDeletes;
    protected $primaryKey='complain_id';
    protected $dates = ['deleted_at'];
    protected $table = 'products';

    /**
     * Complain belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = user_id)
    	return $this->belongsTo('App\User','user_id','user_id');
    }

    /**
     * Complain belongs to Feedback.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feedback()
    {
    	// belongsTo(RelatedModel, foreignKey = feedback_id, keyOnRelatedModel = feedback_id)
    	return $this->belongsTo('App\Feedback','feedback_id','feedback_id');
    }

    
}
