<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;
    protected $primaryKey='curr_id';
    protected $dates = ['deleted_at'];
    protected $table = 'currencies';

    /**
     * Currency has many Rewards.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rewards()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = curr_id, localKey = curr_id)
    	return $this->hasMany('App\Reward','curr_id','curr_id');
    }

    /**
     * Currency has many TransistionHistories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transistionHistories()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = curr_id, localKey = curr_id)
        return $this->hasMany('App\TransistionHistory','curr_id','curr_id');
    }

    /**
     * Currency has many TransistionHistories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = curr_id, localKey = curr_id)
        return $this->hasMany('App\Bill','curr_id','curr_id');
    }

    /**
     * Currency has many SPShippings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SPShippings()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = curr_id, localKey = curr_id)
        return $this->hasMany('App\SPShipping','curr_id','curr_id');
    }
    /**
     * Currency has many ReturnedItems.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function returnedItems()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = curr_id, localKey = curr_id)
        return $this->hasMany('App\ReturnedItem','curr_id','curr_id');
    }

    /**
     * Currency has many WalletRecharges.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function walletRecharges()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = curr_id, localKey = id)
        return $this->hasMany(WalletRecharge::class,'curr_id','curr_id');
    }
     /**
      * Currency has many Users.
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasMany
      */
     public function users()
     {
         // hasMany(RelatedModel, foreignKeyOnRelatedModel = currency_id, localKey = id)
       return $this->hasMany('App\User','curr_id','curr_id');
   }
}
