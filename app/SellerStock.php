<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerStock extends Model
{
    use SoftDeletes;
    protected $primaryKey='ss_id';
    protected $dates = ['deleted_at'];
    protected $table = 'seller_stocks';

    /**
     * SellerStock belongs to SellerProducts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProducts()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('App\SellerProducts','sp_id','sp_id');
    }

    /**
     * SellerStock has many SellerStockHistories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellerStockHistories()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = ss_id, localKey = ss_id)
        return $this->hasMany('App\SellerStockHistory','ss_id','ss_id');
    }
}
