<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reward extends Model
{
    use SoftDeletes;
    protected $primaryKey='reward_id';
    protected $dates = ['deleted_at'];
    protected $table = 'rewards';

    /**
     * Reward belongs to Seller.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
    	// belongsTo(RelatedModel, foreignKey = from_seller_id, keyOnRelatedModel = seller_id)
    	return $this->belongsTo('App\Seller','from_seller_id','seller_id');
    }

    /**
     * Reward belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	// belongsTo(RelatedModel, foreignKey = to_user_id, keyOnRelatedModel = user_id)
    	return $this->belongsTo('App\User','to_user_id','user_id');
    }


    /**
     * Reward belongs to Currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
    	// belongsTo(RelatedModel, foreignKey = curr_id, keyOnRelatedModel = curr_id)
    	return $this->belongsTo('App\Currency','curr_id','curr_id');
    }

    /**
     * Reward has many RewardHistories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rewardHistories()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = reward_id, localKey = reward_id)
        return $this->hasMany('App\RewardHistory','reward_id','reward_id');
    }
}
