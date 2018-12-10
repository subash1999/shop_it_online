<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Seller extends Model
{
    use SoftDeletes;
    protected $primaryKey='seller_id';
    protected $dates = ['deleted_at','dob'];
    protected $table = 'sellers';

    public function user(){
    	return $this->hasOne('App\User','user_id','user_id');
    }

    /**
     * Seller has one SellerPrivacy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sellerPrivacy()
    {
    	// hasOne(RelatedModel, foreignKeyOnRelatedModel = seller_id, localKey = id)
    	return $this->hasOne('App\SellerPrivacy','seller_id','seller_id');
    }

    /**
     * Seller has many SellerProducts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellerProducts()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = seller_id, localKey = id)
        return $this->hasMany('App\SellerProduct','seller_id','seller_id');
    }

    /**
     * Seller has many Rewards.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rewards()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = from_seller_id, localKey = seller_id)
        return $this->hasMany('App\Reward','from_seller_id','seller_id');
    }

    /**
     * Seller has many SellerPayments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellerPayments()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = seller_id, localKey = seller_id)
        return $this->hasMany('App\SellerPayment','seller_id','seller_id');
    }
}
