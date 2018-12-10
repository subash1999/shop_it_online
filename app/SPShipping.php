<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SPShipping extends Model
{
    use SoftDeletes;
    protected $primaryKey='sp_ship_id';
    protected $dates = ['deleted_at'];
    protected $table = 's_p_shippings';

    /**
     * SPShipping belongs to SellerProduct.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sellerProduct()
    {
    	// belongsTo(RelatedModel, foreignKey = sp_id, keyOnRelatedModel = sp_id)
    	return $this->belongsTo('App\SellerProduct','sp_id','sp_id');
    }

    /**
     * SPShipping belongs to Currency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
    	// belongsTo(RelatedModel, foreignKey = curr_id, keyOnRelatedModel = curr_id)
    	return $this->belongsTo('App\Currency','curr_id','curr_id');
    }
}
