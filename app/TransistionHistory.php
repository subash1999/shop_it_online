<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransistionHistory extends Model
{
    use SoftDeletes;
    protected $primaryKey='th_id';
    protected $dates = ['deleted_at'];
    protected $table = 'transistion_histories';

    /**
     * TransistionHistory belongs to Customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	// belongsTo(RelatedModel, foreignKey = cus_id, keyOnRelatedModel = cus_id)
    	return $this->belongsTo('App\User','user_id','user_id');
    }

    /**
     * TransistionHistory belongs to Seller.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
    	// belongsTo(RelatedModel, foreignKey = seller_id, keyOnRelatedModel = seller_id)
    	return $this->belongsTo('App\Seller','seller_id','seller_id');
    }

    /**
     * TransistionHistory belongs to Package.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
    	// belongsTo(RelatedModel, foreignKey = pac_id, keyOnRelatedModel = pac_id)
    	return $this->belongsTo('App\Package','pac_id','pac_id');
    }

    /**
     * TransistionHistory belongs to Offer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offer()
    {
    	// belongsTo(RelatedModel, foreignKey = offer_id, keyOnRelatedModel = offer_id)
    	return $this->belongsTo('App\Offer','offer_id','offer_id');
    }


    /**
     * TransistionHistory has one BillTransistionRelation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function billTransistionRelation()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = transistionHistory_id, localKey = id)
        return $this->hasOne('App\BillTransistionRelation','th_id','th_id');
    }

    /**
     * TransistionHistory belongs to Currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        // belongsTo(RelatedModel, foreignKey = curr_id, keyOnRelatedModel = curr_id)
        return $this->belongsTo('App\Currency','curr_id','curr_id');
    }

     /**
     * TransistionHistory belongs to Currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function SPOptionRelation()
     {
        // belongsTo(RelatedModel, foreignKey = curr_id, keyOnRelatedModel = curr_id)
        return $this->belongsTo('App\SPOptionRelation','spor_id','spor_id');
    }


    /**
     * TransistionHistory belongs to SPSubDivision.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SPSubDivision()
    {
        // belongsTo(RelatedModel, foreignKey = spsd_id, keyOnRelatedModel = spsd_id)
        return $this->belongsTo('App\SPSubDivision','spsd_id','spsd_id  ');
    }
/**
     * TransistionHistory belongs to sellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
            // belongsTo(RelatedModel, foreignKey = spsd_id, keyOnRelatedModel = spsd_id)
        return $this->belongsTo('App\sellerProduct','sp_id','sp_id');
    }
    /**
     * TransistionHistory has one SellerPaymentByWebsite.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellerPaymentByWebsite()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = th_id, localKey = th_id)
        return $this->hasOne('App\SellerPaymentByWebsite','th_id','th_id');
    }
    /**
     * TransistionHistory has many Items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = th_id, localKey = th_id)
        return $this->hasMany('App\Item','th_id','th_id');
    }
}
