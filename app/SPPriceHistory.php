<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SPPriceHistory extends Model
{
    use SoftDeletes;
    protected $primaryKey='sp_price_history_id';
    protected $dates = ['deleted_at'];
    protected $table = 's_p_price_histories';

    /**
     * SPPriceHistory belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sellerProduct_id, keyOnRelatedModel = id)
    	return $this->belongsTo('App\SellerProduct','sp_id','sp_id');
    }
    /**
     * SPPriceHistory belongs to Currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        // belongsTo(RelatedModel, foreignKey = currency_id, keyOnRelatedModel = id)
        return $this->belongsTo('App\Currency','curr_id','curr_id');
    }
}
