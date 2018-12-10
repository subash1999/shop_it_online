<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SPSubDivision extends Model
{
    use SoftDeletes;
    protected $primaryKey='spsd_id';
    protected $dates = ['deleted_at'];
    protected $table = 's_p_sub_divisions';

    /**
     * SPSubDivision has many ShoppingCarts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shoppingCarts()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = spsd_id, localKey = spsd_id)
    	return $this->hasMany('App\ShoppingCart','spsd_id','spsd_id');
    }
    /**
     * SPSubDivision has many wishlist.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlist()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = spsd_id, localKey = spsd_id)
        return $this->hasMany('App\Wishlist','spsd_id','spsd_id');
    }

    /**
     * SPSubDivision has many TransistionHistories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transistionHistories()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = spsd_id, localKey = spsd_id)
        return $this->hasMany('App\TransistionHistory','spsd_id','spsd_id');
    }

    /**
     * SPSubDivision has many Bills.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = spsd_id, localKey = spsd_id)
        return $this->hasMany('App\Bill','spsd_id','spsd_id');
    }

    /**
     * SPSubDivision has many SellerStockHistories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellerStockHistories()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = spsd_id, localKey = spsd_id)
        return $this->hasMany('App\SellerStockHistory','spsd_id','spsd_id');
    }

    /**
     * SPSubDivision has many SPSubDivisionOptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SPSubDivisionOptions()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = spsd_id, localKey = spsd_id)
        return $this->hasMany('App\SPSubDivisionOptionRelation','spsd_id','spsd_id');
    }
}
