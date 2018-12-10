<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RewardHistory extends Model
{
    use SoftDeletes;
    protected $primaryKey='reward_h_id';
    protected $dates = ['deleted_at'];
    protected $table = 'reward_histories';

    /**
     * RewardHistory belongs to Reward.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reward()
    {
    	// belongsTo(RelatedModel, foreignKey = reward_id, keyOnRelatedModel = reward_id)
    	return $this->belongsTo('App\Reward','reward_id','reward_id');
    }
}
